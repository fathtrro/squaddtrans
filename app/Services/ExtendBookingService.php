<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\BookingExtension;
use App\Models\Payment;
use App\Notifications\ExtensionStatusNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExtendBookingService
{
    private BookingConflictService $conflictService;
    private CarStatusService $carStatusService;

    public function __construct(BookingConflictService $conflictService, CarStatusService $carStatusService)
    {
        $this->conflictService = $conflictService;
        $this->carStatusService = $carStatusService;
    }

    /**
     * Request booking extension.
     * Check for conflicts and create extension request.
     *
     * @param Booking $booking
     * @param Carbon $newEndDatetime
     * @return array ['success' => bool, 'message' => string, 'extension' => ?BookingExtension]
     */
    public function requestExtension(Booking $booking, Carbon $newEndDatetime): array
    {
        // Validate booking status
        if ($booking->status !== 'running') {
            return [
                'success' => false,
                'message' => 'Perpanjangan hanya dapat diajukan saat booking sedang berjalan',
                'extension' => null,
            ];
        }

        // Check if there's already a pending extension request
        $pendingExtension = BookingExtension::where('booking_id', $booking->id)
            ->where('status', 'requested')
            ->first();

        if ($pendingExtension) {
            return [
                'success' => false,
                'message' => 'Anda sudah memiliki permintaan perpanjangan yang menunggu persetujuan admin. Silakan tunggu sampai admin memberikan keputusan.',
                'extension' => null,
            ];
        }

        // Check for conflicts
        $conflictCheck = $this->conflictService->checkExtensionConflict($booking, $newEndDatetime);
        if ($conflictCheck['has_conflict']) {
            return [
                'success' => false,
                'message' => 'Mobil sudah dibooking pengguna lain di waktu yang Anda minta. Silakan pilih waktu lain.',
                'extension' => null,
            ];
        }

        // Calculate extra price
        $oldEnd = $booking->end_datetime;
        $hoursExtra = max(1, $oldEnd->diffInHours($newEndDatetime));
        $hourlyRate = ($booking->car && $booking->car->price_24h) ? ($booking->car->price_24h / 24) : 0;
        $extraPrice = round($hourlyRate * $hoursExtra, 2);

        // Create extension request
        $extension = BookingExtension::create([
            'booking_id' => $booking->id,
            'old_end_datetime' => $oldEnd,
            'new_end_datetime' => $newEndDatetime,
            'extra_price' => $extraPrice,
            'status' => 'requested',
        ]);

        return [
            'success' => true,
            'message' => 'Permintaan perpanjangan berhasil dikirim. Menunggu persetujuan admin.',
            'extension' => $extension,
        ];
    }

    /**
     * Approve booking extension.
     * Update booking end_datetime and total_price, create payment if needed.
     *
     * @param BookingExtension $extension
     * @return array ['success' => bool, 'message' => string]
     */
    public function approveExtension(BookingExtension $extension): array
    {
        if ($extension->status !== 'requested') {
            return [
                'success' => false,
                'message' => 'Perpanjangan sudah diproses sebelumnya',
            ];
        }

        return DB::transaction(function () use ($extension) {
            // Update extension status
            $extension->update(['status' => 'approved']);

            // Update booking
            $booking = $extension->booking;
            $booking->update([
                'end_datetime' => $extension->new_end_datetime,
                'total_price' => $booking->total_price + $extension->extra_price,
            ]);

            // Create payment for extra price
            Payment::create([
                'booking_id' => $booking->id,
                'payment_type' => 'extension',
                'amount' => $extension->extra_price,
                'payment_method' => 'pending', // Will be updated when user pays
                'status' => 'pending',
            ]);

            // Update car status if needed
            $this->carStatusService->updateCarStatusFromBooking($booking);

            // Notify user
            $booking->user->notify(new ExtensionStatusNotification($extension, 'approved'));

            return [
                'success' => true,
                'message' => 'Perpanjangan disetujui. End datetime dan harga telah diperbarui.',
            ];
        });
    }

    /**
     * Reject booking extension.
     *
     * @param BookingExtension $extension
     * @return array ['success' => bool, 'message' => string]
     */
    public function rejectExtension(BookingExtension $extension): array
    {
        if ($extension->status !== 'requested') {
            return [
                'success' => false,
                'message' => 'Perpanjangan sudah diproses sebelumnya',
            ];
        }

        $extension->update(['status' => 'rejected']);

        // Notify user
        $extension->booking->user->notify(new ExtensionStatusNotification($extension, 'rejected'));

        return [
            'success' => true,
            'message' => 'Perpanjangan ditolak.',
        ];
    }
}
