<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Payment;
use App\Models\CarChecklist;
use App\Models\Penalty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Total Revenue (from completed payments and bookings)
        $totalRevenue = Payment::where('status', 'approved')
            ->sum('amount');

        // Active Rentals (bookings currently running)
        $activeRentals = Booking::where('status', 'running')->count();

        // Pending Approvals (pending payments and booking extensions)
        $pendingApprovals = Payment::where('status', 'pending')->count();

        // Maintenance Issues (cars in maintenance status)
        $maintenanceUrgent = Car::where('status', 'maintenance')->count();

        // Fleet Status
        $totalCars = Car::count();
        $carsRented = Car::where('status', 'rented')->count();
        $carsAvailable = Car::where('status', 'available')->count();
        $carsInService = Car::where('status', 'maintenance')->count();

        // Calculate percentages
        $rentedPercentage = $totalCars > 0 ? round(($carsRented / $totalCars) * 100) : 0;
        $availablePercentage = $totalCars > 0 ? round(($carsAvailable / $totalCars) * 100) : 0;
        $servicePercentage = $totalCars > 0 ? round(($carsInService / $totalCars) * 100) : 0;

        // Monthly Revenue Data (last 12 months)
        $monthlyRevenue = Payment::where('status', 'approved')
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month');

        // Ensure all 12 months are represented
        $revenueData = [];
        $monthNames = ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AUG', 'SEP', 'OKT', 'NOV', 'DES'];
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[$monthNames[$i-1]] = $monthlyRevenue->get($i, 0);
        }

        // Recent Bookings (last 10)
        $recentBookings = Booking::with('user', 'car')
            ->latest('created_at')
            ->take(10)
            ->get();

        // Calculate max revenue for chart scaling
        $maxRevenue = max(array_values($revenueData)) > 0 ? max(array_values($revenueData)) : 1;

        // Revenue trend (percentage change from last month)
        $currentMonth = Carbon::now()->month;
        $previousMonth = $currentMonth === 1 ? 12 : $currentMonth - 1;
        $currentMonthCode = $monthNames[$currentMonth - 1];
        $previousMonthCode = $monthNames[$previousMonth - 1];
        
        $currentMonthRevenue = $revenueData[$currentMonthCode] ?? 0;
        $previousMonthRevenue = $revenueData[$previousMonthCode] ?? 0;

        $revenueTrend = $previousMonthRevenue > 0
            ? (($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100
            : 0;

        // Total Bookings Count
        $totalBookings = Booking::count();
        $completedBookings = Booking::where('status', 'completed')->count();
        $cancelledBookings = Booking::where('status', 'cancelled')->count();

        return view('admin.dashboard', [
            'totalRevenue' => $totalRevenue,
            'activeRentals' => $activeRentals,
            'pendingApprovals' => $pendingApprovals,
            'maintenanceUrgent' => $maintenanceUrgent,
            'totalCars' => $totalCars,
            'carsRented' => $carsRented,
            'carsAvailable' => $carsAvailable,
            'carsInService' => $carsInService,
            'rentedPercentage' => $rentedPercentage,
            'availablePercentage' => $availablePercentage,
            'servicePercentage' => $servicePercentage,
            'revenueData' => $revenueData,
            'maxRevenue' => $maxRevenue,
            'recentBookings' => $recentBookings,
            'revenueTrend' => $revenueTrend,
            'totalBookings' => $totalBookings,
            'completedBookings' => $completedBookings,
            'cancelledBookings' => $cancelledBookings,
        ]);
    }
}
