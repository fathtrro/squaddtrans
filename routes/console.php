<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('booking:update-status')->everyMinute();

// Mark expired bookings daily at midnight
Schedule::command('bookings:mark-expired')
    ->daily()
    ->at('00:00')
    ->onSuccess(function () {
        \Log::info('Expired bookings marked successfully');
    })
    ->onFailure(function () {
        \Log::error('Failed to mark expired bookings');
    });
