<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Car::with('images');

        // Filter by status if provided
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $cars = $query->latest()->paginate(12);

        // Count cars by status
        $totalCars = Car::count();
        $availableCars = Car::where('status', 'available')->count();
        $rentedCars = Car::where('status', 'rented')->count();
        $maintenanceCars = Car::where('status', 'maintenance')->count();

        return view('admin.car.index', compact(
            'cars',
            'totalCars',
            'availableCars',
            'rentedCars',
            'maintenanceCars'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.car.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'plate_number' => 'required|string|max:50|unique:cars,plate_number',
            'year' => 'required|digits:4|integer|min:1990',
            'category' => 'required|string|max:255',
            'seats' => 'required|integer|min:1',
            'transmission' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:255',
            'price_12h' => 'required|numeric|min:0',
            'price_24h' => 'required|numeric|min:0',

            // multiple images
            'images' => 'required|array|min:3',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:5120',
        ]);

        DB::transaction(function () use ($request) {

            // simpan mobil
            $car = Car::create([
                'name' => $request->name,
                'brand' => $request->brand,
                'plate_number' => $request->plate_number,
                'year' => $request->year,
                'category' => $request->category,
                'seats' => $request->seats,
                'transmission' => $request->transmission,
                'fuel_type' => $request->fuel_type,
                'price_12h' => $request->price_12h,
                'price_24h' => $request->price_24h,
                'status' => 'available',
            ]);

            // simpan foto
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');

                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => $path,
                ]);
            }
        });

        return redirect()
            ->route('admin.car.index')
            ->with('success', 'Armada berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $car->load('images');
        return view('admin.car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $car->load('images');
        return view('admin.car.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'plate_number' => 'required|string|unique:cars,plate_number,' . $car->id,
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'category' => 'required|string|max:255',
            'seats' => 'required|integer|min:1',
            'transmission' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:255',
            'price_12h' => 'required|numeric|min:0',
            'price_24h' => 'required|numeric|min:0',
            'status' => 'required|in:available,booked,rented,maintenance',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'exists:car_images,id',
        ]);

        // Upload new main image
        if ($request->hasFile('image')) {
            // Delete old image
            if ($car->image && Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($validated);

        // Remove selected images
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageId) {
                $carImage = CarImage::find($imageId);
                if ($carImage && $carImage->car_id == $car->id) {
                    if (Storage::disk('public')->exists($carImage->image_path)) {
                        Storage::disk('public')->delete($carImage->image_path);
                    }
                    $carImage->delete();
                }
            }
        }

        // Upload additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                $car->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.car.index')
            ->with('success', 'Armada berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        // Delete main image
        if ($car->image && Storage::disk('public')->exists($car->image)) {
            Storage::disk('public')->delete($car->image);
        }

        // Delete additional images
        foreach ($car->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
        }

        $car->delete();

        return redirect()->route('admin.car.index')
            ->with('success', 'Armada berhasil dihapus!');
    }
}
