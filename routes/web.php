<?php

use App\Http\Controllers\Admin\RenterController;
use App\Http\Controllers\BookingController;
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
    });



require __DIR__ . '/auth.php';
