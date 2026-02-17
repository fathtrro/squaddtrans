<?php

namespace App\Services;

use App\Models\Penalty;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Exception;

class PenaltyManagementService
{
    /**
     * Approve/mark penalty as paid
     * Creates payment record and potentially changes booking status
     */
    public function approvePenalty(Penalty $penalty, array $paymentData = []): array
    {
        if ($penalty->status === Penalty::STATUS_PAID) {
            throw new Exception('Denda ini sudah dibayar.');
        }

        try {
            return DB::transaction(function () use ($penalty, $paymentData) {
                // Mark penalty as paid
                $penalty->markAsPaid();

                // Create payment record
                $payment = Payment::create([
                    'booking_id' => $penalty->booking_id,
                    'payment_type' => Payment::TYPE_PENALTY,
                    'amount' => $penalty->amount,
                    'payment_method' => $paymentData['payment_method'] ?? 'transfer',
                    'bank_id' => $paymentData['bank_id'] ?? null,
                    'proof_image' => $paymentData['proof_image'] ?? null,
                    'status' => Payment::STATUS_APPROVED,
                    'paid_at' => now(),
                ]);

                // Check if all penalties for this booking are paid
                $booking = $penalty->booking;
                $unpaidPenalties = $booking->penalties()->where('status', Penalty::STATUS_UNPAID)->count();

                // If no more unpaid penalties, update booking status to completed
                if ($unpaidPenalties === 0) {
                    $booking->update(['status' => Booking::STATUS_COMPLETED]);
                    $statusMessage = 'Semua denda lunas. Booking selesai!';
                } else {
                    $statusMessage = "Masih ada {$unpaidPenalties} denda yang perlu dibayar.";
                }

                return [
                    'success' => true,
                    'message' => 'Denda berhasil ditandai sebagai dibayar.',
                    'status_message' => $statusMessage,
                    'payment' => $payment,
                    'remaining_penalties' => $unpaidPenalties,
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
     * Get penalty summary for booking
     */
    public function getPenaltySummary(Booking $booking): array
    {
        $penalties = $booking->penalties()->get();

        return [
            'total_penalties' => $penalties->count(),
            'unpaid_count' => $penalties->where('status', Penalty::STATUS_UNPAID)->count(),
            'paid_count' => $penalties->where('status', Penalty::STATUS_PAID)->count(),
            'total_amount' => $penalties->sum('amount'),
            'unpaid_amount' => $penalties->where('status', Penalty::STATUS_UNPAID)->sum('amount'),
            'paid_amount' => $penalties->where('status', Penalty::STATUS_PAID)->sum('amount'),
            'penalties' => $penalties->map(function ($penalty) {
                return [
                    'id' => $penalty->id,
                    'type' => $penalty->type_label,
                    'description' => $penalty->description,
                    'amount' => $penalty->amount,
                    'status' => $penalty->status_label,
                    'created_at' => $penalty->created_at,
                ];
            })->toArray(),
        ];
    }

    /**
     * Get late return penalty amount
     * Calculate based on hours overdue
     */
    public function calculateLateReturnPenalty(Booking $booking): float
    {
        if ($booking->hasAfterChecklist()) {
            return 0; // Already returned, no late penalty
        }

        $endTime = $booking->end_datetime;
        $now = now();

        if ($now <= $endTime) {
            return 0; // Not late yet
        }

        // Calculate hours overdue
        $hoursOverdue = $now->diffInHours($endTime);

        // Calculate penalty: Rp 50.000 per jam (can be customized)
        $penaltyPerHour = 50000;
        return $hoursOverdue * $penaltyPerHour;
    }

    /**
     * Create late return penalty
     */
    public function createLateReturnPenalty(Booking $booking): ?Penalty
    {
        // Only create if no after checklist and overdue
        if ($booking->hasAfterChecklist() || !$booking->isOverdue()) {
            return null;
        }

        // Check if late penalty already exists
        $existingPenalty = $booking->penalties()
            ->where('type', Penalty::TYPE_LATE)
            ->first();

        if ($existingPenalty) {
            return $existingPenalty;
        }

        $amount = $this->calculateLateReturnPenalty($booking);

        if ($amount <= 0) {
            return null;
        }

        return Penalty::create([
            'booking_id' => $booking->id,
            'type' => Penalty::TYPE_LATE,
            'description' => 'Keterlambatan pengembalian kendaraan.',
            'amount' => $amount,
            'status' => Penalty::STATUS_UNPAID,
        ]);
    }

    /**
     * Check if penalty can be paid
     */
    public function canPayPenalty(Penalty $penalty): bool
    {
        return $penalty->status === Penalty::STATUS_UNPAID;
    }

    /**
     * Validate penalty payment
     */
    public function validatePenaltyPayment(Penalty $penalty, array $paymentData): array
    {
        $errors = [];

        if ($penalty->status === Penalty::STATUS_PAID) {
            $errors[] = 'Denda ini sudah dibayar.';
        }

        if (empty($paymentData['payment_method'])) {
            $errors[] = 'Metode pembayaran harus dipilih.';
        }

        if (empty($paymentData['proof_image']) && $paymentData['payment_method'] === 'transfer') {
            $errors[] = 'Bukti transfer harus diunggah.';
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors,
        ];
    }

    /**
     * Get daily penalty summary
     * Useful for admin dashboard
     */
    public function getDailyPenaltySummary(): array
    {
        $today = now()->startOfDay();

        return [
            'today' => [
                'new_penalties' => Penalty::whereDate('created_at', $today)->count(),
                'total_amount' => Penalty::whereDate('created_at', $today)->sum('amount'),
                'paid_count' => Penalty::whereDate('created_at', $today)
                    ->where('status', Penalty::STATUS_PAID)
                    ->count(),
            ],
            'unpaid_total' => Penalty::where('status', Penalty::STATUS_UNPAID)->sum('amount'),
        ];
    }
}
