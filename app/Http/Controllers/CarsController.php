<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CarsController extends Controller
{
    public function index(Request $request)
    {
        // Clear the just_booked session when viewing cars
        session()->forget('just_booked');

        $query = Car::with(['images', 'reviews'])->where('status', '!=', 'maintenance');

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        // Category filter
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        // Price range filter
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price_24h', [$request->min_price, $request->max_price]);
        }

        // Year filter
        if ($request->has('year_range')) {
            switch ($request->year_range) {
                case '2023-2024':
                    $query->whereBetween('year', [2023, 2024]);
                    break;
                case '2020-2022':
                    $query->whereBetween('year', [2020, 2022]);
                    break;
                case 'below-2020':
                    $query->where('year', '<', 2020);
                    break;
            }
        }

        // Fuel type filter
        if ($request->has('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        // Pagination
        $cars = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('cars.index', compact('cars'));
    }

    /**
     * Display a single car detail with booking calendar
     */
    public function show(Car $car)
    {
        // Load relationships
        $car->load([
            'images',
            // load review -> booking -> user to avoid N+1 and ensure booking/user available
            'reviews.booking.user',
            'bookings' => function ($query) {
                // Only load confirmed and active bookings for calendar display
                $query->whereIn('status', ['confirmed', 'active'])
                    ->select('id', 'car_id', 'start_datetime', 'end_datetime', 'status');
            }
        ]);

        // Get related cars (same category, exclude current car)
        // FIXED: Removed is_available condition
        $relatedCars = Car::with('images')
            ->where('category', $car->category)
            ->where('id', '!=', $car->id)
            ->where('status', 'available')  // Only check status
            ->limit(4)
            ->get();

        // Calculate average rating
        $averageRating = $car->reviews->avg('rating') ?? 0;
        $totalReviews = $car->reviews->count();

        // Get booking statistics
        $bookingStats = $this->getBookingStats($car);

        // Reviews for this car (from bookings)
        $carReviews = $car->reviews()
            ->with(['booking.user', 'booking.car'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('cars.show', compact(
            'car',
            'relatedCars',
            'averageRating',
            'totalReviews',
            'bookingStats',
            'carReviews'
        ));
    }

    /**
     * Check availability for specific dates
     */
    public function checkAvailability(Request $request, Car $car)
    {
        $durationMode = $request->get('duration_mode', '24');

        // Validate based on duration mode
        if ($durationMode === '12') {
            // For 12-hour: end_date can be same as start_date
            $validated = $request->validate([
                'start_date' => 'required|date|after_or_equal:today',
                'end_date' => 'required|date|after_or_equal:start_date',
                'duration_mode' => 'required|in:12',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i',
            ]);
        } else {
            // For 24-hour: end_date must be after start_date
            $validated = $request->validate([
                'start_date' => 'required|date|after_or_equal:today',
                'end_date' => 'required|date|after:start_date',
                'duration_mode' => 'required|in:24',
            ]);
        }

        // Build start and end datetime based on duration mode
        if ($durationMode === '12') {
            $startTime = $request->get('start_time', '00:00');
            $endTime = $request->get('end_time', '00:00');
            $startDateTime = Carbon::createFromFormat('Y-m-d H:i',
                $request->start_date . ' ' . $startTime);
            $endDateTime = Carbon::createFromFormat('Y-m-d H:i',
                $request->end_date . ' ' . $endTime);
        } else {
            // For 24-hour mode, assume full day rental (00:00 to 23:59)
            $startDateTime = Carbon::parse($request->start_date)->startOfDay();
            $endDateTime = Carbon::parse($request->end_date)->endOfDay();
        }

        // Check if car has any booking overlapping with requested period
        $hasBooking = $car->bookings()
            ->whereIn('status', ['confirmed', 'active'])
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween('start_datetime', [$startDateTime, $endDateTime])
                    ->orWhereBetween('end_datetime', [$startDateTime, $endDateTime])
                    ->orWhere(function ($q) use ($startDateTime, $endDateTime) {
                        $q->where('start_datetime', '<=', $startDateTime)
                            ->where('end_datetime', '>=', $endDateTime);
                    });
            })
            ->exists();

        return response()->json([
            'available' => !$hasBooking,
            'message' => $hasBooking
                ? 'Mobil sudah dibooking pada tanggal tersebut'
                : 'Mobil tersedia untuk tanggal yang dipilih'
        ]);
    }

    /**
     * Get booked dates for calendar display
     */
    /**
     * Get booked dates for calendar display
     */
    public function getBookedDates(Car $car, Request $request)
    {
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));

        // Get bookings for the requested month
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth();

        $bookings = $car->bookings()
            ->with('user:id,name')
            ->whereIn('status', ['pending', 'confirmed', 'running'])
            ->where(function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('start_datetime', [$startOfMonth, $endOfMonth])
                    ->orWhereBetween('end_datetime', [$startOfMonth, $endOfMonth])
                    ->orWhere(function ($q) use ($startOfMonth, $endOfMonth) {
                        $q->where('start_datetime', '<=', $startOfMonth)
                            ->where('end_datetime', '>=', $endOfMonth);
                    });
            })
            ->get(['id', 'user_id', 'start_datetime', 'end_datetime', 'status', 'booking_code']);

        // Convert bookings to array of dates with booking info
        $bookedDates = [];
        $bookingDetails = [];

        foreach ($bookings as $booking) {
            $start = Carbon::parse($booking->start_datetime);
            $end = Carbon::parse($booking->end_datetime);

            $bookingInfo = [
                'booking_code' => $booking->booking_code,
                'user_name' => $booking->user ? $booking->user->name : 'User',
                'status' => $booking->status,
                'start' => $start->format('d M Y'),
                'end' => $end->format('d M Y')
            ];

            while ($start <= $end) {
                $dateStr = $start->format('Y-m-d');
                $bookedDates[] = $dateStr;
                $bookingDetails[$dateStr] = $bookingInfo;
                $start->addDay();
            }
        }

        return response()->json([
            'booked_dates' => array_unique($bookedDates),
            'booking_details' => $bookingDetails,
            'month' => $month,
            'year' => $year
        ]);
    }

    /**
     * Get booking statistics for the car
     */
    private function getBookingStats(Car $car)
    {
        $totalBookings = $car->bookings()->count();
        $activeBookings = $car->bookings()->where('status', 'active')->count();
        $completedBookings = $car->bookings()->where('status', 'completed')->count();

        // Calculate booking rate (percentage of days booked in last 30 days)
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $recentBookings = $car->bookings()
            ->whereIn('status', ['confirmed', 'active', 'completed'])
            ->where('start_datetime', '>=', $thirtyDaysAgo)
            ->get();

        $bookedDays = 0;
        foreach ($recentBookings as $booking) {
            $start = Carbon::parse($booking->start_datetime);
            $end = Carbon::parse($booking->end_datetime);
            $bookedDays += $start->diffInDays($end) + 1;
        }

        $bookingRate = min(100, round(($bookedDays / 30) * 100, 1));

        // Get next available date
        $nextAvailableDate = $this->getNextAvailableDate($car);

        return [
            'total_bookings' => $totalBookings,
            'active_bookings' => $activeBookings,
            'completed_bookings' => $completedBookings,
            'booking_rate' => $bookingRate,
            'next_available_date' => $nextAvailableDate
        ];
    }

    /**
     * Find the next available date for the car
     */
    private function getNextAvailableDate(Car $car)
    {
        $today = Carbon::today();
        $maxDate = Carbon::today()->addMonths(3);

        // Get all booked dates in the next 3 months
        $bookings = $car->bookings()
            ->whereIn('status', ['confirmed', 'active'])
            ->where('start_datetime', '<=', $maxDate)
            ->where('end_datetime', '>=', $today)
            ->orderBy('start_datetime')
            ->get(['start_datetime', 'end_datetime']);

        $currentDate = $today->copy();

        while ($currentDate <= $maxDate) {
            $isBooked = false;

            foreach ($bookings as $booking) {
                $bookingStart = Carbon::parse($booking->start_datetime)->startOfDay();
                $bookingEnd = Carbon::parse($booking->end_datetime)->endOfDay();

                if ($currentDate->between($bookingStart, $bookingEnd)) {
                    $isBooked = true;
                    // Jump to the day after this booking ends
                    $currentDate = $bookingEnd->copy()->addDay()->startOfDay();
                    break;
                }
            }

            if (!$isBooked) {
                return $currentDate->format('Y-m-d');
            }
        }

        return null; // No available date found in the next 3 months
    }

    /**
     * Get price estimate based on rental duration
     */
    public function getPriceEstimate(Request $request, Car $car)
    {
        $durationMode = $request->get('duration_mode', '24');

        // Validate based on duration mode
        if ($durationMode === '12') {
            // For 12-hour: end_date can be same as start_date
            $validated = $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'service_type' => 'required|in:lepas_kunci,dengan_sopir,carter',
                'duration_mode' => 'required|in:12',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i',
            ]);
        } else {
            // For 24-hour: end_date must be after start_date
            $validated = $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'service_type' => 'required|in:lepas_kunci,dengan_sopir,carter',
                'duration_mode' => 'required|in:24',
            ]);
        }

        $basePrice = 0;
        $days = 0;

        // Calculate base price based on duration mode
        if ($durationMode === '12') {
            // For 12-hour rental: use 70% of 24-hour price
            $basePrice = $car->price_24h * 0.7;
            $days = 1; // Count as 1 unit for calculation
        } else {
            // For 24-hour rental: standard full day calculation
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            $days = $startDate->diffInDays($endDate);
            $basePrice = $car->price_24h * $days;
        }

        // Additional charges based on service type
        $serviceCharge = 0;
        switch ($request->service_type) {
            case 'dengan_sopir':
                $serviceCharge = 150000 * $days; // Driver fee per day
                break;
            case 'carter':
                $serviceCharge = 200000 * $days; // Carter service fee per day
                break;
        }

        $totalPrice = $basePrice + $serviceCharge;
        $minDeposit = $totalPrice * 0.3; // 30% minimum deposit

        return response()->json([
            'days' => $days,
            'base_price' => $basePrice,
            'service_charge' => $serviceCharge,
            'total_price' => $totalPrice,
            'min_deposit' => $minDeposit,
            'currency' => 'IDR'
        ]);
    }
}
