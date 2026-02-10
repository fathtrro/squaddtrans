<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Booking;

class CarStatusService
{
    /**
     * Update car status based on booking status.
     * confirmed → booked
     * running → rented
     * completed → available (if no pending bookings)
     * cancelled → check other bookings
     *
     * @param Booking $booking
     * @return void
     */
    public function updateCarStatusFromBooking(Booking $booking): void
    {
        $car = $booking->car;

        if ($booking->status === 'confirmed') {
            $car->update(['status' => 'booked']);
        } elseif ($booking->status === 'running') {
            $car->update(['status' => 'rented']);
        } elseif ($booking->status === 'completed' || $booking->status === 'cancelled') {
            // Check if there are any active bookings for this car
            $hasActiveBooking = Booking::where('car_id', $car->id)
                ->whereIn('status', ['confirmed', 'running'])
                ->exists();

            if (!$hasActiveBooking) {
                $car->update(['status' => 'available']);
            }
        }
    }

    /**
     * Bulk update car status based on all bookings.
     * Use this for periodic maintenance.
     *
     * @return int Number of cars updated
     */
    public function syncAllCarStatuses(): int
    {
        $cars = Car::all();
        $updated = 0;

        foreach ($cars as $car) {
            $activeBooking = Booking::where('car_id', $car->id)
                ->whereIn('status', ['confirmed', 'running'])
                ->latest('start_datetime')
                ->first();

            if ($activeBooking) {
                if ($activeBooking->status === 'confirmed') {
                    $car->update(['status' => 'booked']);
                } elseif ($activeBooking->status === 'running') {
                    $car->update(['status' => 'rented']);
                }
                $updated++;
            } else {
                if ($car->status !== 'available') {
                    $car->update(['status' => 'available']);
                    $updated++;
                }
            }
        }

        return $updated;
    }
}
