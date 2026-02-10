<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class UpdateBookingStatus extends Command
{
    protected $signature = 'booking:update-status';
    protected $description = 'Auto update status booking berdasarkan waktu sewa';

    public function handle()
    {
        $now = Carbon::now();

        /**
         * CONFIRMED → RUNNING
         * Saat waktu sewa dimulai
         */
        Booking::where('status', 'confirmed')
            ->where('start_datetime', '<=', $now)
            ->where('end_datetime', '>=', $now)
            ->update(['status' => 'running']);

        // running → completed
        Booking::where('status', 'running')
            ->where('end_datetime', '<', $now)
            ->update(['status' => 'completed']);


        $this->info('Status booking berhasil diperbarui.');
    }
}
