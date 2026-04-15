<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\BookingExtension;
use App\Models\Payment;
use App\Notifications\ExtensionStatusNotification;
use App\Traits\SendsWhatsAppNotifications;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExtendBookingService
{
    use SendsWhatsAppNotifications;

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

        // Send WhatsApp to user
        try {
            $userPhone = $booking->contact ?? $booking->user->phone;
            if ($userPhone) {
                $userMessage = "📅 *Perpanjangan Sewa Diterima*\n\n" .
                    "Halo " . ($booking->user->name ?? 'Pelanggan') . ",\n\n" .
                    "Permintaan perpanjangan sewa Anda untuk booking *" . $booking->booking_code . "* sudah kami terima dan sedang diproses oleh tim admin kami.\n\n" .
                    "📋 *Detail Perpanjangan:*\n" .
                    "• Waktu Kembali Baru: " . $newEndDatetime->format('d M Y, H:i') . "\n" .
                    "• Biaya Tambahan: Rp " . number_format($extraPrice, 0, ',', '.') . "\n\n" .
                    "⏳ Kami akan segera memberikan notifikasi persetujuan atau penolakan dalam waktu 1x24 jam.\n\n" .
                    "Terima kasih telah menggunakan layanan kami! 🙏";

                $this->sendFonnteWhatsApp($userPhone, $userMessage);
            }
        } catch (\Throwable $e) {
            logger()->warning('Failed to send WhatsApp to user for extension request: ' . $e->getMessage());
        }

        // Send WhatsApp to admin
        try {
            $adminPhone = env('ADMIN_PHONE');
            if ($adminPhone) {
                $adminMessage = "🔔 *Permintaan Perpanjangan Baru*\n\n" .
                    "Ada permintaan perpanjangan sewa dari pelanggan:\n\n" .
                    "👤 *Nama Pelanggan:* " . ($booking->user->name ?? 'N/A') . "\n" .
                    "📱 *Nomor HP:* " . ($booking->user->phone ?? 'N/A') . "\n" .
                    "🔖 *Booking Code:* *" . $booking->booking_code . "*\n" .
                    "🚗 *Kendaraan:* " . ($booking->car->name ?? 'N/A') . "\n\n" .
                    "📝 *Detail Perpanjangan:*\n" .
                    "• Waktu Kembali Saat Ini: " . $oldEnd->format('d M Y, H:i') . "\n" .
                    "• Waktu Kembali Baru: " . $newEndDatetime->format('d M Y, H:i') . "\n" .
                    "• Biaya Tambahan: Rp " . number_format($extraPrice, 0, ',', '.') . "\n\n" .
                    "Silakan review dan lakukan persetujuan atau penolakan melalui dashboard admin.\n" .
                    "Link: " . config('app.url') . "/admin/booking-extensions";

                $this->sendFonnteWhatsApp($adminPhone, $adminMessage);
            }
        } catch (\Throwable $e) {
            logger()->warning('Failed to send WhatsApp to admin for extension request: ' . $e->getMessage());
        }

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

            // Send WhatsApp to user
            try {
                $userPhone = $booking->contact ?? $booking->user->phone;
                if ($userPhone) {
                    $userMessage = "✅ *Perpanjangan Sewa Disetujui!*\n\n" .
                        "Halo " . ($booking->user->name ?? 'Pelanggan') . ",\n\n" .
                        "Selamat! Permintaan perpanjangan sewa Anda untuk booking *" . $booking->booking_code . "* telah disetujui oleh admin kami.\n\n" .
                        "📋 *Detail Perpanjangan yang Disetujui:*\n" .
                        "• Waktu Kembali Baru: " . $extension->new_end_datetime->format('d M Y, H:i') . "\n" .
                        "• Biaya Tambahan: Rp " . number_format($extension->extra_price, 0, ',', '.') . "\n" .
                        "• Total Harga Akhir: Rp " . number_format($booking->total_price, 0, ',', '.') . "\n\n" .
                        "💳 *Langkah Selanjutnya:*\n" .
                        "Silakan selesaikan pembayaran untuk biaya perpanjangan melalui aplikasi atau hubungi customer service kami.\n\n" .
                        "Terima kasih! 🙏";

                    $this->sendFonnteWhatsApp($userPhone, $userMessage);
                }
            } catch (\Throwable $e) {
                logger()->warning('Failed to send WhatsApp approval to user: ' . $e->getMessage());
            }

            // Send WhatsApp to admin
            try {
                $adminPhone = env('ADMIN_PHONE');
                if ($adminPhone) {
                    $adminMessage = "✅ *Perpanjangan Disetujui*\n\n" .
                        "Booking Code: *" . $booking->booking_code . "*\n" .
                        "Pelanggan: " . ($booking->user->name ?? 'N/A') . "\n" .
                        "Biaya: Rp " . number_format($extension->extra_price, 0, ',', '.') . "\n\n" .
                        "Status: Sudah disetujui dan notifikasi telah dikirim ke pelanggan.";

                    $this->sendFonnteWhatsApp($adminPhone, $adminMessage);
                }
            } catch (\Throwable $e) {
                logger()->warning('Failed to send WhatsApp approval to admin: ' . $e->getMessage());
            }

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
        $booking = $extension->booking;

        // Send WhatsApp to user
        try {
            $userPhone = $booking->contact ?? $booking->user->phone;
            if ($userPhone) {
                $userMessage = "⚠️ *Perpanjangan Sewa Ditolak*\n\n" .
                    "Halo " . ($booking->user->name ?? 'Pelanggan') . ",\n\n" .
                    "Permintaan perpanjangan sewa Anda untuk booking *" . $booking->booking_code . "* telah ditolak oleh tim admin kami.\n\n" .
                    "📋 *Detail:*\n" .
                    "• Waktu Kembali Awal: " . $extension->old_end_datetime->format('d M Y, H:i') . "\n" .
                    "• Waktu Kembali yang Diminta: " . $extension->new_end_datetime->format('d M Y, H:i') . "\n\n" .
                    "Kemungkinan alasan penolakan:\n" .
                    "• Jadwal kendaraan sudah penuh\n" .
                    "• Ketersediaan terbatas\n" .
                    "• Alasan administratif lainnya\n\n" .
                    "📞 *Hubungi Kami:*\n" .
                    "Jika Anda ingin membahas lebih lanjut atau mencari solusi alternatif, silakan hubungi customer service kami:\n" .
                    "📱 " . env('ADMIN_PHONE', '+62 812-3328-3578') . "\n\n" .
                    "Terima kasih atas pemahaman Anda. 🙏";

                $this->sendFonnteWhatsApp($userPhone, $userMessage);
            }
        } catch (\Throwable $e) {
            logger()->warning('Failed to send WhatsApp rejection to user: ' . $e->getMessage());
        }

        // Send WhatsApp to admin
        try {
            $adminPhone = env('ADMIN_PHONE');
            if ($adminPhone) {
                $adminMessage = "❌ *Perpanjangan Ditolak*\n\n" .
                    "Booking Code: *" . $booking->booking_code . "*\n" .
                    "Pelanggan: " . ($booking->user->name ?? 'N/A') . "\n" .
                    "Biaya yang Ditawarkan: Rp " . number_format($extension->extra_price, 0, ',', '.') . "\n\n" .
                    "Status: Sudah ditolak dan notifikasi telah dikirim ke pelanggan.";

                $this->sendFonnteWhatsApp($adminPhone, $adminMessage);
            }
        } catch (\Throwable $e) {
            logger()->warning('Failed to send WhatsApp rejection to admin: ' . $e->getMessage());
        }

        // Notify user
        $booking->user->notify(new ExtensionStatusNotification($extension, 'rejected'));

        return [
            'success' => true,
            'message' => 'Perpanjangan ditolak.',
        ];
    }
}
