<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarsController;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', function () {
    $cars = Car::with('images')->where('status', 'available')->limit(3)->get();
    return view('dashboard', compact('cars'));
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

    Route::get('/bookings/success', [BookingController::class, 'success'])
        ->name('bookings.success');

    Route::get('/bookings/{booking}', [BookingController::class, 'show'])
        ->name('bookings.show');

});

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
        Route::resource('car', CarController::class);
    });



require __DIR__ . '/auth.php';
