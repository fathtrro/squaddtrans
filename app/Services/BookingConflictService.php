<?php

namespace App\Services;

use App\Models\Booking;
use Carbon\Carbon;

class BookingConflictService
{
    /**
     * Check if there are any booking conflicts for a car in a given time range.
     * Exclude a specific booking if provided.
     *
     * @param int $carId
     * @param Carbon $startDatetime
     * @param Carbon $endDatetime
     * @param int|null $excludeBookingId
     * @return bool
     */
    public function hasConflict(int $carId, Carbon $startDatetime, Carbon $endDatetime, ?int $excludeBookingId = null): bool
    {
        $query = Booking::where('car_id', $carId)
            ->whereIn('status', ['confirmed', 'running', 'completed'])
            ->where(function ($q) use ($startDatetime, $endDatetime) {
                // Check for overlapping bookings
                $q->whereBetween('start_datetime', [$startDatetime, $endDatetime])
                    ->orWhereBetween('end_datetime', [$startDatetime, $endDatetime])
                    ->orWhere(function ($sub) use ($startDatetime, $endDatetime) {
                        $sub->where('start_datetime', '<=', $startDatetime)
                            ->where('end_datetime', '>=', $endDatetime);
                    });
            });

        if ($excludeBookingId) {
            $query->where('id', '!=', $excludeBookingId);
        }

        return $query->exists();
    }

    /**
     * Get conflicting bookings for a car in a given time range.
     *
     * @param int $carId
     * @param Carbon $startDatetime
     * @param Carbon $endDatetime
     * @param int|null $excludeBookingId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getConflicts(int $carId, Carbon $startDatetime, Carbon $endDatetime, ?int $excludeBookingId = null)
    {
        $query = Booking::where('car_id', $carId)
            ->whereIn('status', ['confirmed', 'running', 'completed'])
            ->where(function ($q) use ($startDatetime, $endDatetime) {
                $q->whereBetween('start_datetime', [$startDatetime, $endDatetime])
                    ->orWhereBetween('end_datetime', [$startDatetime, $endDatetime])
                    ->orWhere(function ($sub) use ($startDatetime, $endDatetime) {
                        $sub->where('start_datetime', '<=', $startDatetime)
                            ->where('end_datetime', '>=', $endDatetime);
                    });
            });

        if ($excludeBookingId) {
            $query->where('id', '!=', $excludeBookingId);
        }

        return $query->get(['id', 'booking_code', 'start_datetime', 'end_datetime', 'status']);
    }

    /**
     * Check if extension would conflict with other bookings.
     * Useful for extension requests.
     *
     * @param Booking $booking
     * @param Carbon $newEndDatetime
     * @return array ['has_conflict' => bool, 'conflicts' => Collection]
     */
    public function checkExtensionConflict(Booking $booking, Carbon $newEndDatetime): array
    {
        $hasConflict = $this->hasConflict(
            $booking->car_id,
            $booking->start_datetime,
            $newEndDatetime,
            $booking->id
        );

        $conflicts = [];
        if ($hasConflict) {
            $conflicts = $this->getConflicts(
                $booking->car_id,
                $booking->end_datetime,
                $newEndDatetime,
                $booking->id
            )->toArray();
        }

        return [
            'has_conflict' => $hasConflict,
            'conflicts' => $conflicts,
        ];
    }
}
