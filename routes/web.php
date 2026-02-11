<?php

use App\Http\Controllers\Admin\RenterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingExtensionController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', function () {
    $cars = Car::with('images')->where('status', 'available')->limit(3)->get();
    return view('dashboard', compact('cars'));
});
 push
// Search cars API with autocomplete
Route::get('/api/search-cars', function (Illuminate\Http\Request $request) {
    $search = $request->query('q', '');

    if (strlen($search) < 1) {
        return response()->json([]);
    }

    $cars = Car::where('status', 'available')
        ->where(function ($query) use ($search) {
            $query->where('brand', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhereRaw("CONCAT(brand, ' ', name) LIKE ?", ["%{$search}%"]);
        })
        ->select('id', 'brand', 'name', 'price_24h')
        ->limit(10)
        ->get()
        ->map(function ($car) {
            return [
                'id' => $car->id,
                'label' => "{$car->brand} {$car->name}",
                'brand' => $car->brand,
                'name' => $car->name,
                'price' => 'Rp ' . number_format($car->price_24h, 0, ',', '.'),
            ];
        });

    return response()->json($cars);
});

Route::prefix('api/cars/{car}')->name('cars.')->group(function () {
    // Check availability for specific dates
    Route::post('/check-availability', [CarsController::class, 'checkAvailability'])
        ->name('check-availability');

    // Get booked dates for calendar
    Route::get('/booked-dates', [CarsController::class, 'getBookedDates'])
        ->name('booked-dates');

    // Get price estimate
    Route::post('/price-estimate', [CarsController::class, 'getPriceEstimate'])
        ->name('price-estimate');
});
// Car routes (public)
Route::get('/Armada', [CarsController::class, 'index'])->name('cars.index');
Route::get('/cars', [CarsController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [CarsController::class, 'show'])->name('cars.show');

// Booking routes (requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])
        ->name('bookings.index');

    Route::get('/bookings/create', [BookingController::class, 'create'])
        ->name('bookings.create');

    Route::post('/bookings/store', [BookingController::class, 'store'])
        ->name('bookings.store');

    Route::get('/bookings/success/{booking}', [BookingController::class, 'success'])
        ->name('bookings.success');


    Route::get('/bookings/{booking}/download', [BookingController::class, 'downloadReceipt'])
        ->name('bookings.download');

    Route::get('/bookings/{booking}', [BookingController::class, 'show'])
        ->name('bookings.show');

    // Extension routes (User)
    Route::post('/bookings/{booking}/extend', [BookingExtensionController::class, 'store'])
        ->name('bookings.extend');
    Route::post('/bookings/{booking}/extend-conflict', [BookingExtensionController::class, 'checkConflict'])
        ->name('bookings.extend-conflict');

    // Review routes
    Route::get('/reviews/create', [ReviewController::class, 'create'])
        ->name('reviews.create');

    Route::post('/reviews/store', [ReviewController::class, 'store'])
        ->name('reviews.store');

});
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/dashboard', function () {
    $cars = Car::with('images')->where('status', 'available')->limit(3)->get();
    return view('dashboard', compact('cars'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'dashboard'])
            ->name('dashboard');
        Route::get('/laporan', [ReportController::class, 'laporan'])
            ->name('laporan');
        Route::resource('car', CarController::class);
        Route::resource('inbox', InboxController::class);
        Route::resource('renter', RenterController::class);

        // Booking extension management
        Route::get('/booking-extensions', [BookingExtensionController::class, 'index'])
            ->name('booking-extensions.index');
        Route::post('/booking-extensions/{extension}/approve', [BookingExtensionController::class, 'approve'])
            ->name('booking-extensions.approve');
        Route::post('/booking-extensions/{extension}/reject', [BookingExtensionController::class, 'reject'])
            ->name('booking-extensions.reject');
    });



require __DIR__ . '/auth.php';
