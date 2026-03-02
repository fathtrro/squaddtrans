<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class MarkExpiredBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:mark-expired {--dry-run : Tampilkan tanpa mengubah data}';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Tandai booking dengan status pending yang sudah terlewati tanggalnya menjadi expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        // Cari semua booking yang expired
        $expiredBookings = Booking::expired()->get();

        if ($expiredBookings->isEmpty()) {
            $this->info('✓ Tidak ada booking yang perlu diubah menjadi expired');
            return 0;
        }

        $count = $expiredBookings->count();

        if ($isDryRun) {
            $this->warn("🔍 DRY RUN MODE - Akan mengubah {$count} booking menjadi expired:");
            $this->line('');

            $this->table(
                ['ID', 'Kode Booking', 'Tanggal Mulai', 'Status'],
                $expiredBookings->map(function ($booking) {
                    return [
                        $booking->id,
                        $booking->booking_code,
                        $booking->start_datetime->format('Y-m-d H:i'),
                        $booking->status,
                    ];
                })->toArray()
            );

            $this->line('');
            $this->info('✓ Jalankan tanpa --dry-run untuk benar-benar mengubah status');
            return 0;
        }

        // Update semua booking
        foreach ($expiredBookings as $booking) {
            $booking->markAsExpired();
            $this->comment("Booking #{$booking->id} ({$booking->booking_code}) ditandai sebagai expired");
        }

        $this->info("✓ Berhasil mengubah {$count} booking menjadi status expired");

        return 0;
    }
}
