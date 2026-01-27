<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index(Request $request)
    {
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
     * Display a single car detail
     */
    public function show(Car $car)
    {
        if ($car->status !== 'available') {
            abort(404, 'Mobil ini tidak tersedia');
        }

        $car->load(['images', 'reviews', 'bookings']);

        // Get related cars (same category)
        $relatedCars = Car::where('category', $car->category)
            ->where('id', '!=', $car->id)
            ->where('status', 'available')
            ->limit(4)
            ->get();

        // Calculate average rating
        $averageRating = $car->reviews->avg('rating') ?? 0;
        $totalReviews = $car->reviews->count();

        return view('cars.show', compact('car', 'relatedCars', 'averageRating', 'totalReviews'));
    }
}
