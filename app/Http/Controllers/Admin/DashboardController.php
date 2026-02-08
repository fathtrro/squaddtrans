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
        // Total Revenue (from completed payments)
        $totalRevenue = Payment::where('status', 'approved')
            ->sum('amount');

        // Active Rentals (bookings currently running or overlapping now)
        $activeRentals = Booking::where('status', 'running')
            ->orWhere(function ($query) {
                $query->where('start_datetime', '<=', now())
                    ->where('end_datetime', '>=', now());
            })
            ->count();

        // Pending Approvals (pending payments)
        $pendingApprovals = Payment::where('status', 'pending')->count();

        // Maintenance (detect checklist entries that likely indicate issues)
        // The `car_checklists` table in your schema has fields like
        // body_condition, interior_condition, fuel_level, accessories, notes.
        // We'll count checklists where any of those fields suggest a non-ok state.
        $maintenanceUrgent = CarChecklist::where(function ($q) {
                $q->whereNotNull('body_condition')->where('body_condition', '!=', 'ok')
                  ->orWhere(function ($q2) {
                      $q2->whereNotNull('interior_condition')->where('interior_condition', '!=', 'ok');
                  })
                  ->orWhere(function ($q3) {
                      $q3->whereNotNull('accessories')->where('accessories', '!=', 'ok');
                  })
                  ->orWhere(function ($q4) {
                      $q4->whereNotNull('fuel_level')->where('fuel_level', '!=', 'full');
                  })
                  ->orWhere(function ($q5) {
                      $q5->whereNotNull('notes')->where('notes', '!=', '');
                  });
            })->count();

        // Fleet Status
        $totalCars = Car::count();
        $carsRented = Booking::where('status', 'running')
            ->orWhere(function ($query) {
                $query->where('start_datetime', '<=', now())
                    ->where('end_datetime', '>=', now());
            })
            ->distinct('car_id')
            ->count('car_id');

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
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[$i] = $monthlyRevenue->get($i, 0);
        }

        // Recent Bookings
        $recentBookings = Booking::with('user', 'car')
            ->latest('created_at')
            ->take(5)
            ->get();

        // Calculate max revenue for chart scaling
        $maxRevenue = max($revenueData) > 0 ? max($revenueData) : 1;

        // Revenue trend (percentage change from last month)
        $currentMonth = Carbon::now()->month;
        $previousMonth = $currentMonth === 1 ? 12 : $currentMonth - 1;
        $currentMonthRevenue = $revenueData[$currentMonth] ?? 0;
        $previousMonthRevenue = $revenueData[$previousMonth] ?? 0;

        $revenueTrend = $previousMonthRevenue > 0
            ? (($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100
            : 0;

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
        ]);
    }
}
