<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Mark expired bookings daily at midnight
        $schedule->command('bookings:mark-expired')
            ->daily()
            ->at('00:00')
            ->onSuccess(function () {
                \Log::info('Expired bookings marked successfully');
            })
            ->onFailure(function () {
                \Log::error('Failed to mark expired bookings');
            });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
