<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Car;
use App\Models\Penalty;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function laporan(Request $request)
    {
        // Get all bookings with relations
        $query = Booking::with('user', 'car', 'payments', 'penalties')
            ->latest('created_at');

        // Apply filters if provided
        if ($request->filled('start_date')) {
            $query->whereDate('start_datetime', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('end_datetime', '<=', $request->end_date);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(15);

        // Transform bookings data to include calculated fields
        $bookingData = $bookings->map(function ($booking) {
            // Calculate duration in days
            $duration = $booking->start_datetime->diffInDays($booking->end_datetime) + 1;

            // Get total payment (sum of all approved payments)
            $totalPaid = $booking->payments()
                ->where('status', 'approved')
                ->sum('amount');

            // Get total penalty
            $totalPenalty = $booking->penalties()->sum('amount') ?? 0;

            return [
                'id' => $booking->id,
                'booking_code' => $booking->booking_code,
                'customer_name' => $booking->user->name ?? 'N/A',
                'car_brand' => $booking->car->brand ?? 'N/A',
                'car_name' => $booking->car->name ?? 'N/A',
                'car_full_name' => ($booking->car->brand ?? '') . ' ' . ($booking->car->name ?? ''),
                'plate_number' => $booking->car->plate_number ?? 'N/A',
                'start_date' => $booking->start_datetime->format('d-m-y'),
                'end_date' => $booking->end_datetime->format('d-m-y'),
                'duration' => $duration,
                'total_price' => $booking->total_price,
                'total_paid' => $totalPaid,
                'penalty' => $totalPenalty,
                'status' => $booking->status,
                'created_at' => $booking->created_at,
            ];
        });

        // Calculate summary statistics
        $totalRevenue = Payment::where('status', 'approved')->sum('amount');
        $totalPenalties = Penalty::sum('amount') ?? 0;
        $totalBookings = Booking::count();
        $completedBookings = Booking::where('status', 'completed')->count();

        // Monthly revenue for last 12 months
        $monthlyRevenue = Payment::where('status', 'approved')
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month');

        // Ensure all 12 months are represented
        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[$i] = $monthlyRevenue->get($i, 0);
        }

        // Most popular cars (by number of bookings)
        $popularCars = Car::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(5)
            ->get();

        // Average booking duration
        $avgDuration = Booking::selectRaw('AVG(DATEDIFF(end_datetime, start_datetime) + 1) as avg_days')
            ->first()
            ->avg_days ?? 0;

        // Average rating (if reviews exist)
        $avgRating = 4.8; // Placeholder - adjust based on your review model

        // Calculate max revenue for chart scaling
        $maxRevenue = max($revenueData) > 0 ? max($revenueData) : 1;

        return view('admin.laporan', [
            'bookingData' => $bookingData,
            'totalRevenue' => $totalRevenue,
            'totalPenalties' => $totalPenalties,
            'totalBookings' => $totalBookings,
            'completedBookings' => $completedBookings,
            'revenueData' => $revenueData,
            'maxRevenue' => $maxRevenue,
            'popularCars' => $popularCars,
            'avgDuration' => round($avgDuration, 1),
            'avgRating' => $avgRating,
            'bookings' => $bookings,
        ]);
    }
}
