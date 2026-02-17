<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\CarChecklist;
use App\Models\CarChecklistPhoto;
use App\Models\Penalty;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;

class ReturnBookingService
{
    /**
     * Submit return for a booking
     *
     * @param Booking $booking
     * @param array $data - Contains: body_condition, interior_condition, fuel_level, accessories, notes
     * @param array $photos - Files array: ['photo_file' => UploadedFile]
     *
     * @return array ['success' => bool, 'message' => string, 'penalties' => Collection]
     */
    public function submitReturn(Booking $booking, array $data, array $photos = [])
    {
        // Validate requirements
        if (!$booking->hasBeforeChecklist()) {
            throw new Exception('Checklist sebelum perjalanan tidak ditemukan. Tidak bisa melakukan return.');
        }

        if ($booking->status !== Booking::STATUS_RUNNING) {
            throw new Exception('Status booking harus "Sedang Berjalan" untuk melakukan return.');
        }

        try {
            return DB::transaction(function () use ($booking, $data, $photos) {
                // Step 1: Create after checklist
                $afterChecklist = $this->createAfterChecklist($booking, $data);

                // Step 2: Save photos
                if (!empty($photos)) {
                    $this->saveChecklistPhotos($afterChecklist, $photos);
                }

                // Step 3: Compare and find damages
                $damages = $this->analyzeDamages($booking, $afterChecklist);

                // Step 4: Create penalties if damages found
                $penalties = [];
                if (!empty($damages)) {
                    $penalties = $this->createPenalties($booking, $damages);
                    // Update status to waiting for penalty payment
                    $booking->update(['status' => Booking::STATUS_WAITING_PENALTY]);
                } else {
                    // No damages, directly to completed
                    $booking->update(['status' => Booking::STATUS_COMPLETED]);
                }

                return [
                    'success' => true,
                    'message' => empty($damages)
                        ? 'Proses return berhasil tanpa kerusakan. Booking selesai!'
                        : 'Proses return berhasil. Denda ditemukan dan perlu dibayar.',
                    'penalties' => collect($penalties),
                    'damages' => $damages,
                    'after_checklist' => $afterChecklist,
                ];
            });
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'penalties' => collect([]),
            ];
        }
    }

    /**
     * Create after checklist
     */
    private function createAfterChecklist(Booking $booking, array $data): CarChecklist
    {
        return $booking->checklists()->create([
            'checklist_type' => 'after',
            'body_condition' => $data['body_condition'] ?? null,
            'interior_condition' => $data['interior_condition'] ?? null,
            'fuel_level' => $data['fuel_level'] ?? null,
            'accessories' => $data['accessories'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);
    }

    /**
     * Save checklist photos
     */
    private function saveChecklistPhotos(CarChecklist $checklist, array $photos): void
    {
        foreach ($photos as $category => $files) {
            // Handle single file
            if (is_object($files) && method_exists($files, 'store')) {
                $path = $files->store('checklist/' . $checklist->id, 'public');
                CarChecklistPhoto::create([
                    'car_checklist_id' => $checklist->id,
                    'photo_path' => $path,
                    'category' => $category,
                ]);
            }
            // Handle array of files
            else if (is_array($files)) {
                foreach ($files as $file) {
                    if (is_object($file) && method_exists($file, 'store')) {
                        $path = $file->store('checklist/' . $checklist->id, 'public');
                        CarChecklistPhoto::create([
                            'car_checklist_id' => $checklist->id,
                            'photo_path' => $path,
                            'category' => $category,
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Analyze damages by comparing before and after checklist
     */
    private function analyzeDamages(Booking $booking, CarChecklist $afterChecklist): array
    {
        $beforeChecklist = $booking->getBeforeChecklist();
        if (!$beforeChecklist) {
            return [];
        }

        $damages = [];

        // Check body condition
        if ($this->hasChange($beforeChecklist->body_condition, $afterChecklist->body_condition)) {
            $damages[] = [
                'type' => Penalty::TYPE_DAMAGE,
                'field' => 'Kondisi Bodi',
                'before' => $beforeChecklist->body_condition,
                'after' => $afterChecklist->body_condition,
                'severity' => $this->calculateSeverity($beforeChecklist->body_condition, $afterChecklist->body_condition),
            ];
        }

        // Check interior condition
        if ($this->hasChange($beforeChecklist->interior_condition, $afterChecklist->interior_condition)) {
            $damages[] = [
                'type' => Penalty::TYPE_DAMAGE,
                'field' => 'Kondisi Interior',
                'before' => $beforeChecklist->interior_condition,
                'after' => $afterChecklist->interior_condition,
                'severity' => $this->calculateSeverity($beforeChecklist->interior_condition, $afterChecklist->interior_condition),
            ];
        }

        // Check fuel level (late return penalty if less fuel)
        if ($this->hasFuelDecrease($beforeChecklist->fuel_level, $afterChecklist->fuel_level)) {
            // This could be normal usage, so maybe don't count as damage
            // But can count as fuel needed to refill
        }

        // Check accessories
        if ($this->hasChange($beforeChecklist->accessories, $afterChecklist->accessories)) {
            $damages[] = [
                'type' => Penalty::TYPE_DAMAGE,
                'field' => 'Aksesori/Perlengkapan',
                'before' => $beforeChecklist->accessories,
                'after' => $afterChecklist->accessories,
                'severity' => 'medium',
            ];
        }

        return $damages;
    }

    /**
     * Check if there's a change
     */
    private function hasChange($before, $after): bool
    {
        return trim($before ?? '') !== trim($after ?? '');
    }

    /**
     * Check if fuel decreased
     */
    private function hasFuelDecrease($before, $after): bool
    {
        $beforeVal = (int) preg_replace('/\D/', '', $before ?? '0');
        $afterVal = (int) preg_replace('/\D/', '', $after ?? '0');
        return $beforeVal > $afterVal;
    }

    /**
     * Calculate damage severity (simple: low, medium, high)
     */
    private function calculateSeverity(string $before, string $after): string
    {
        // Check keywords in after condition
        $severity = 'low';

        $heavyDamageWords = ['rusak berat', 'patah', 'hancur', 'tidak berfungsi', 'pecah'];
        $mediumDamageWords = ['rusak', 'goresan', 'penyok', 'noda', 'kotor'];

        $afterLower = strtolower($after);

        foreach ($heavyDamageWords as $word) {
            if (str_contains($afterLower, $word)) {
                return 'high';
            }
        }

        foreach ($mediumDamageWords as $word) {
            if (str_contains($afterLower, $word)) {
                $severity = 'medium';
            }
        }

        return $severity;
    }

    /**
     * Create penalties from damages
     */
    private function createPenalties(Booking $booking, array $damages): array
    {
        $penalties = [];

        foreach ($damages as $damage) {
            // Calculate penalty amount based on severity
            $amount = $this->calculatePenaltyAmount($damage['severity']);

            $penalty = Penalty::create([
                'booking_id' => $booking->id,
                'type' => $damage['type'],
                'description' => "{$damage['field']}: {$damage['before']} → {$damage['after']}",
                'amount' => $amount,
                'status' => Penalty::STATUS_UNPAID,
            ]);

            $penalties[] = $penalty;
        }

        return $penalties;
    }

    /**
     * Calculate penalty amount based on severity
     * Can be customized per business rule
     */
    private function calculatePenaltyAmount(string $severity): float
    {
        return match($severity) {
            'low' => 50000,      // Rp 50.000
            'medium' => 200000,  // Rp 200.000
            'high' => 500000,    // Rp 500.000
            default => 100000,   // Rp 100.000
        };
    }

    /**
     * Check if booking can be returned
     */
    public function canReturn(Booking $booking): bool
    {
        return $booking->status === Booking::STATUS_RUNNING && $booking->hasBeforeChecklist();
    }

    /**
     * Check if booking can be completed (all penalties paid or none)
     */
    public function canComplete(Booking $booking): bool
    {
        return $booking->hasAfterChecklist() && !$booking->hasUnpaidPenalties();
    }
}
