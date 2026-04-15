<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use App\Traits\SendsWhatsAppNotifications;
use Illuminate\Support\Facades\DB;
use Exception;

class BookingCompletionService
{
    use SendsWhatsAppNotifications;
    /**
     * Complete a booking
     * Check all requirements and set status to completed
     */
    public function complete(Booking $booking): array
    {
        // Validation
        if ($booking->status === Booking::STATUS_COMPLETED) {
            throw new Exception('Booking sudah selesai.');
        }

        if (!$booking->hasAfterChecklist()) {
            throw new Exception('Checklist setelah perjalanan belum dilakukan.');
        }

        if ($booking->hasUnpaidPenalties()) {
            throw new Exception('Masih ada denda yang belum dibayar.');
        }

        try {
            return DB::transaction(function () use ($booking) {
                // Update status
                $booking->update(['status' => Booking::STATUS_COMPLETED]);

                // Generate final report
                $report = $this->generateFinalReport($booking);

                // Send WhatsApp completion notification to user
                try {
                    $userPhone = $booking->contact ?? $booking->user->phone;
                    if ($userPhone) {
                        $totalCost = $report['payment']['total_price_final'];
                        $completionMessage = "🎉 *Proses Rental Mobil Selesai!*\n\n" .
                            "Halo " . ($booking->user->name ?? 'Pelanggan') . ",\n\n" .
                            "Proses rental mobil Anda telah selesai dengan sempurna. Terima kasih telah menggunakan layanan kami!\n\n" .
                            "📋 *Ringkasan Transaksi:*\n" .
                            "🔖 Kode Booking: *" . $booking->booking_code . "*\n" .
                            "🚗 Kendaraan: " . $booking->car->name . "\n" .
                            "📅 Tanggal: " . $booking->start_datetime->format('d M Y') . " - " . $booking->end_datetime->format('d M Y') . "\n" .
                            "⏱️ Durasi: " . $booking->duration_in_days . " hari\n\n" .
                            "💳 *Rincian Biaya:*\n" .
                            "• Total Biaya Sewa: Rp " . number_format($report['payment']['booking_price'], 0, ',', '.') . "\n" .
                            "• Total Terbayar: Rp " . number_format($report['payment']['total_paid'], 0, ',', '.') . "\n";

                        if ($report['payment']['penalty_paid'] > 0) {
                            $completionMessage .= "• Denda: Rp " . number_format($report['payment']['penalty_paid'], 0, ',', '.') . "\n";
                        }

                        $completionMessage .= "\n✅ *Status: SELESAI*\n\n" .
                            "📝 Terima kasih telah percaya pada kami. Kami berharap Anda puas dengan layanan kami.\n\n" .
                            "⭐ Jika Anda puas, mohon tinggalkan ulasan di aplikasi kami.\n" .
                            "📞 Jika ada pertanyaan atau masukan, hubungi kami: " . env('ADMIN_PHONE', '+62 812-3328-3578') . "\n\n" .
                            "Semoga perjalanan Anda menyenangkan! 🙏";

                        $this->sendFonnteWhatsApp($userPhone, $completionMessage);
                    }
                } catch (\Throwable $e) {
                    logger()->warning('Failed to send WhatsApp completion to user: ' . $e->getMessage());
                }

                // Send WhatsApp notification to admin
                try {
                    $adminPhone = env('ADMIN_PHONE');
                    if ($adminPhone) {
                        $adminMessage = "✅ *Booking Selesai*\n\n" .
                            "Booking Code: *" . $booking->booking_code . "*\n" .
                            "Pelanggan: " . ($booking->user->name ?? 'N/A') . "\n" .
                            "Kendaraan: " . $booking->car->name . "\n" .
                            "Total Biaya: Rp " . number_format($report['payment']['total_price_final'], 0, ',', '.') . "\n" .
                            "Total Terbayar: Rp " . number_format($report['payment']['total_paid'], 0, ',', '.') . "\n\n" .
                            "Status: Booking sudah ditandai selesai di sistem.";

                        $this->sendFonnteWhatsApp($adminPhone, $adminMessage);
                    }
                } catch (\Throwable $e) {
                    logger()->warning('Failed to send WhatsApp completion to admin: ' . $e->getMessage());
                }

                return [
                    'success' => true,
                    'message' => 'Booking berhasil diselesaikan.',
                    'report' => $report,
                ];
            });
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Generate final report for completed booking
     */
    public function generateFinalReport(Booking $booking): array
    {
        // Booking info
        $bookingInfo = [
            'id' => $booking->id,
            'code' => $booking->booking_code,
            'user_name' => $booking->user->name,
            'car_name' => $booking->car->name,
            'service_type' => $booking->service_type_label,
            'start_date' => $booking->formatted_start_date,
            'end_date' => $booking->formatted_end_date,
            'duration_days' => $booking->duration_in_days,
        ];

        // Payment summary
        $dpPayment = $booking->payments()->where('payment_type', Payment::TYPE_DP)->first();
        $finalPayment = $booking->payments()->where('payment_type', Payment::TYPE_FINAL)->first();
        $penaltyPayments = $booking->payments()->where('payment_type', Payment::TYPE_PENALTY)->sum('amount');

        $paymentSummary = [
            'booking_price' => $booking->total_price,
            'dp_paid' => $dpPayment ? $dpPayment->amount : 0,
            'final_paid' => $finalPayment ? $finalPayment->amount : 0,
            'penalty_paid' => $penaltyPayments,
            'total_paid' => $booking->payments()->where('status', Payment::STATUS_APPROVED)->sum('amount'),
            'total_price_final' => $booking->total_price + $booking->getTotalPaidPenalties(),
        ];

        // Penalties
        $penalties = $booking->penalties()->get()->map(function ($penalty) {
            return [
                'type' => $penalty->type_label,
                'description' => $penalty->description,
                'amount' => $penalty->amount,
                'status' => $penalty->status_label,
            ];
        })->toArray();

        // Checklists
        $beforeChecklist = $booking->getBeforeChecklist();
        $afterChecklist = $booking->getAfterChecklist();

        $checklistSummary = [
            'before' => $beforeChecklist ? [
                'body_condition' => $beforeChecklist->body_condition,
                'interior_condition' => $beforeChecklist->interior_condition,
                'fuel_level' => $beforeChecklist->fuel_level,
                'accessories' => $beforeChecklist->accessories,
                'notes' => $beforeChecklist->notes,
                'photos_count' => $beforeChecklist->photos()->count(),
            ] : null,
            'after' => $afterChecklist ? [
                'body_condition' => $afterChecklist->body_condition,
                'interior_condition' => $afterChecklist->interior_condition,
                'fuel_level' => $afterChecklist->fuel_level,
                'accessories' => $afterChecklist->accessories,
                'notes' => $afterChecklist->notes,
                'photos_count' => $afterChecklist->photos()->count(),
            ] : null,
        ];

        // Extensions (if any)
        $extensionSummary = $booking->extensions()->get()->map(function ($ext) {
            return [
                'old_end_date' => $ext->old_end_datetime->format('d M Y H:i'),
                'new_end_date' => $ext->new_end_datetime->format('d M Y H:i'),
                'extra_price' => $ext->extra_price,
                'status' => $ext->status_label,
            ];
        })->toArray();

        return [
            'booking' => $bookingInfo,
            'payment' => $paymentSummary,
            'penalties' => $penalties,
            'checklists' => $checklistSummary,
            'extensions' => $extensionSummary,
            'completion_date' => now()->format('d M Y H:i'),
        ];
    }

    /**
     * Get completion status/requirements for a booking
     */
    public function getCompletionStatus(Booking $booking): array
    {
        return [
            'is_completed' => $booking->status === Booking::STATUS_COMPLETED,
            'has_before_checklist' => $booking->hasBeforeChecklist(),
            'has_after_checklist' => $booking->hasAfterChecklist(),
            'unpaid_penalties' => $booking->penalties()->where('status', 'unpaid')->count(),
            'total_unpaid_amount' => $booking->getTotalUnpaidPenalties(),
            'can_complete' => $this->canComplete($booking),
            'message' => $this->getCompletionMessage($booking),
        ];
    }

    /**
     * Check if booking can be completed
     */
    public function canComplete(Booking $booking): bool
    {
        return $booking->status !== Booking::STATUS_COMPLETED
            && $booking->hasAfterChecklist()
            && !$booking->hasUnpaidPenalties();
    }

    /**
     * Get completion message
     */
    public function getCompletionMessage(Booking $booking): string
    {
        if ($booking->status === Booking::STATUS_COMPLETED) {
            return 'Booking sudah selesai.';
        }

        if (!$booking->hasAfterChecklist()) {
            return 'Checklist setelah perjalanan belum dilakukan.';
        }

        $unpaidCount = $booking->penalties()->where('status', 'unpaid')->count();
        if ($unpaidCount > 0) {
            return "Masih ada {$unpaidCount} denda yang belum dibayar.";
        }

        return 'Booking siap untuk diselesaikan.';
    }
}
