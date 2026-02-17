<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Exception;

class BookingCompletionService
{
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
