<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class CarController extends Controller
{
    /**
     * Compress image using GD library and save to storage
     */
    private function compressImage(UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension());

        // Check if required PHP extensions are available
        if (!extension_loaded('gd') || !extension_loaded('fileinfo')) {
            // Extensions not available, store without compression
            return $file->store('cars', 'public');
        }

        try {
            $originalPath = $file->getPathname();

            // Load image based on format
            if ($extension === 'jpg' || $extension === 'jpeg') {
                $source = @imagecreatefromjpeg($originalPath);
            } elseif ($extension === 'png') {
                $source = @imagecreatefrompng($originalPath);
            } elseif ($extension === 'gif') {
                $source = @imagecreatefromgif($originalPath);
            } else {
                // If unsupported, just store without compression
                return $file->store('cars', 'public');
            }

            if (!$source) {
                // Fallback: if image load fails, store without compression
                return $file->store('cars', 'public');
            }

            // Get original dimensions
            $width = imagesx($source);
            $height = imagesy($source);

            // Calculate new dimensions (max 1920 wide, maintain aspect ratio)
            $maxWidth = 1920;
            if ($width > $maxWidth) {
                $newWidth = $maxWidth;
                $newHeight = (int)($height * ($maxWidth / $width));
            } else {
                $newWidth = $width;
                $newHeight = $height;
            }

            // Create resized image
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // Save compressed image
            $filename = uniqid() . '.' . $extension;
            $path = 'cars/' . $filename;
            $tempPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $filename;

            if ($extension === 'jpg' || $extension === 'jpeg') {
                imagejpeg($resized, $tempPath, 75);
            } elseif ($extension === 'png') {
                imagepng($resized, $tempPath, 8);
            } elseif ($extension === 'gif') {
                imagegif($resized, $tempPath);
            }

            // Move to storage
            Storage::disk('public')->put($path, file_get_contents($tempPath));

            // Cleanup
            if (file_exists($tempPath)) {
                unlink($tempPath);
            }
            imagedestroy($source);
            imagedestroy($resized);

            return $path;
        } catch (\Throwable $e) {
            // If any error occurs, fallback to simple storage
            return $file->store('cars', 'public');
        }
    }

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

        // Search by brand, model, or license plate
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('brand', 'like', '%' . $search . '%')
                    ->orWhere('model', 'like', '%' . $search . '%')
                    ->orWhere('license_plate', 'like', '%' . $search . '%');
            });
        }

        $cars = $query->latest()->paginate(12)->withQueryString();

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
            'price_24h' => 'required|numeric|min:0',

            // multiple images
            'images' => 'required|array|min:3',
            'images.*' => 'image|extensions:jpg,jpeg,png|max:8192',
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
                'price_24h' => (int) preg_replace('/[^\d]/', '', $request->price_24h),
                'status' => 'available',
            ]);

            // simpan foto
            foreach ($request->file('images') as $image) {
                $path = $this->compressImage($image);

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
            'price_24h' => 'required|numeric|min:0',
            'status' => 'required|in:available,booked,rented,maintenance',
            'image' => 'nullable|image|extensions:jpeg,png,jpg,gif|max:8192',
            'images.*' => 'nullable|image|extensions:jpeg,png,jpg,gif|max:8192',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'exists:car_images,id',
        ]);

        // Parse price_24h to remove formatting characters
        $validated['price_24h'] = (int) preg_replace('/[^\d]/', '', $validated['price_24h']);

        // Upload new main image
        if ($request->hasFile('image')) {
            // Delete old image
            if ($car->image && Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }
            $validated['image'] = $this->compressImage($request->file('image'));
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
                $path = $this->compressImage($image);
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
