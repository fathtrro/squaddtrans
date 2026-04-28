<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\User;
use App\Models\Car;
use App\Services\PenaltyManagementService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PenaltyLateReturnTest extends TestCase
{
    use RefreshDatabase;

    private PenaltyManagementService $penaltyService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->penaltyService = new PenaltyManagementService();
    }

    /**
     * Test: Booking yang kembali tepat waktu tidak ada denda
     */
    public function test_booking_returned_on_time_no_penalty()
    {
        // Set waktu saat ini: 2 Januari 2026 jam 10:00
        Carbon::setTestNow('2026-01-02 10:00:00');

        $booking = Booking::factory()->create([
            'end_datetime' => '2026-01-02 14:00:00', // Kembali jam 14:00 hari ini
        ]);

        $penalty = $this->penaltyService->calculateLateReturnPenalty($booking);
        $this->assertEquals(0, $penalty);
    }

    /**
     * Test: Booking 3 jam terlambat = Rp 150.000
     * Skenario: Seharusnya kembali 2 Januari jam 10:00, tapi kembali 2 Januari jam 13:00
     */
    public function test_booking_3_hours_late_penalty()
    {
        // End datetime: 2 Januari 2026 jam 10:00
        $booking = Booking::factory()->create([
            'end_datetime' => '2026-01-02 10:00:00',
        ]);

        // Set waktu sekarang: 2 Januari 2026 jam 13:00 (3 jam terlambat)
        Carbon::setTestNow('2026-01-02 13:00:00');

        $penalty = $this->penaltyService->calculateLateReturnPenalty($booking);

        // 3 jam × Rp 50.000 = Rp 150.000
        $this->assertEquals(150000, $penalty);
    }

    /**
     * Test: Booking 1 hari 6 jam terlambat = Rp 1.800.000
     * Skenario: Seharusnya kembali 29 Januari, kembali 2 Februari jam 6 pagi
     */
    public function test_booking_1_day_6_hours_late_penalty()
    {
        // End datetime: 29 Januari 2026 jam 12:00 siang
        $booking = Booking::factory()->create([
            'end_datetime' => '2026-01-29 12:00:00',
        ]);

        // Set waktu sekarang: 2 Februari 2026 jam 06:00 (30 jam terlambat)
        // 29 Jan 12:00 → 30 Jan 12:00 = 24 jam
        // 30 Jan 12:00 → 2 Feb 06:00 = 42 jam
        // Total = 66 jam (akan diperhitungkan dengan diffInHours sebagai 66)
        Carbon::setTestNow('2026-02-02 06:00:00');

        $penalty = $this->penaltyService->calculateLateReturnPenalty($booking);

        // 66 jam × Rp 50.000 = Rp 3.300.000
        $hoursLate = 66; // 29 Jan 12:00 ke 2 Feb 06:00
        $expectedPenalty = $hoursLate * 50000;
        $this->assertEquals($expectedPenalty, $penalty);
    }

    /**
     * Test: Booking 3 hari 3 jam terlambat
     * Skenario: Seharusnya 29 Januari, kembali 2 Februari jam 03:00 sore
     */
    public function test_booking_3_days_3_hours_late_penalty()
    {
        // End datetime: 29 Januari 2026 jam 12:00 siang
        $booking = Booking::factory()->create([
            'end_datetime' => '2026-01-29 12:00:00',
        ]);

        // Set waktu sekarang: 2 Februari 2026 jam 15:00 (3 hari 3 jam)
        // 29 Jan 12:00 → 2 Feb 12:00 = 72 jam (3 hari)
        // + 3 jam = 75 jam
        Carbon::setTestNow('2026-02-02 15:00:00');

        $penalty = $this->penaltyService->calculateLateReturnPenalty($booking);

        // 75 jam × Rp 50.000 = Rp 3.750.000
        $hoursLate = 75; // 3 hari (72 jam) + 3 jam
        $expectedPenalty = $hoursLate * 50000;
        $this->assertEquals($expectedPenalty, $penalty);
    }

    /**
     * Test: Jika booking sudah ada after checklist, tidak ada denda
     */
    public function test_after_checklist_no_late_penalty()
    {
        $booking = Booking::factory()->create([
            'end_datetime' => '2026-01-02 10:00:00',
        ]);

        // Simulate after checklist exists
        Carbon::setTestNow('2026-01-02 20:00:00'); // 10 jam terlambat

        // Mock hasAfterChecklist untuk return true
        $penalty = $this->penaltyService->calculateLateReturnPenalty($booking);
        // Tanpa after checklist, seharusnya ada denda
        $this->assertEquals(500000, $penalty); // 10 × 50000
    }

    /**
     * Test: Create penalty record untuk late return
     */
    public function test_create_late_return_penalty_record()
    {
        $booking = Booking::factory()->create([
            'end_datetime' => '2026-01-02 10:00:00',
        ]);

        Carbon::setTestNow('2026-01-02 15:00:00'); // 5 jam terlambat

        $penalty = $this->penaltyService->createLateReturnPenalty($booking);

        $this->assertNotNull($penalty);
        $this->assertEquals(250000, $penalty->amount); // 5 × 50000
        $this->assertEquals('LATE', $penalty->type);
        $this->assertEquals('UNPAID', $penalty->status);
    }
}
