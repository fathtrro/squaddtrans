<?php

use App\Http\Controllers\BookingController;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', function () {
    return view('dashboard');
});
Route::get('/Armada', function () {
    return view('car');
});

<<<<<<< HEAD

=======
<<<<<<< Updated upstream
// Authenticated Routes
=======


// Car routes (public)
Route::get('/cars', [CarsController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [CarsController::class, 'show'])->name('cars.show');

// Booking routes (requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/cars/{car}/book', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::delete('/bookings/{booking}', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('/bookings/calculate-price', [BookingController::class, 'calculatePrice'])->name('bookings.calculate-price');
});
>>>>>>> Stashed changes
>>>>>>> 95ebc8dca29c1756055e6bd691b1b3dfed357fa1
Route::get('/dashboard', function () {
    return view('dashboard');
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
