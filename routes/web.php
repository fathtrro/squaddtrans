<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Car;

// Controllers - Public
use App\Http\Controllers\CarsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingExtensionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AgentController;

// Controllers - Admin
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RenterController;
use App\Http\Controllers\Admin\ReturnController;
use App\Http\Controllers\Admin\BankAccountController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;

/* ============================================================
   PUBLIC ROUTES
============================================================ */

// Home
Route::get('/', function () {
    $cars = Car::with('images')->where('status', 'available')->limit(4)->get();
    $mobil = Car::with('images')->where('status', 'available')->limit(10)->get();
    $bookings = \App\Models\Booking::with('car')->where('user_id', auth()->id())->get();

    return view('dashboard', compact('cars', 'mobil', 'bookings'));
});
Route::get('/tentang', function () {return view(view: 'tentang');
});
Route::get('/blog', function () {return view(view: 'blog');
});

// Cars
Route::get('/cars', [CarsController::class, 'index'])->name('cars.index');
Route::get('/Armada', [CarsController::class, 'index']);
Route::get('/cars/{car}', [CarsController::class, 'show'])->name('cars.show');

// Contact
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');

/* ============================================================
   PUBLIC API ROUTES
============================================================ */

Route::prefix('api')->group(function () {

    // Car search autocomplete
    Route::get('/search-cars', function (Request $request) {
        $search = $request->query('q', '');

        if (strlen($search) < 1) {
            return response()->json([]);
        }

        $cars = Car::with('images')
            ->where('status', 'available')
            ->where(function ($query) use ($search) {
                $query->where('brand', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhereRaw("CONCAT(brand, ' ', name) LIKE ?", ["%{$search}%"]);
            })
            ->limit(10)
            ->get()
            ->map(fn($car) => [
                'id' => $car->id,
                'label' => "{$car->brand} {$car->name}",
                'brand' => $car->brand,
                'name' => $car->name,
                'price' => 'Rp ' . number_format($car->price_24h, 0, ',', '.'),
                'image' => $car->images->first()
                    ? asset('storage/' . $car->images->first()->image_path)
                    : null,
            ]);

        return response()->json($cars);
    });

    // Car availability & pricing
    Route::prefix('cars/{car}')->name('cars.')->group(function () {
        Route::post('/check-availability', [CarsController::class, 'checkAvailability'])->name('check-availability');
        Route::get('/booked-dates', [CarsController::class, 'getBookedDates'])->name('booked-dates');
        Route::post('/price-estimate', [CarsController::class, 'getPriceEstimate'])->name('price-estimate');
    });

    // Booking date check
    Route::get('/bookings/check-dates', [BookingController::class, 'checkBookedDates']);
    Route::get('/bookings/available-cars', [BookingController::class, 'getAvailableCars']);
});

/* ============================================================
   AUTHENTICATED USER ROUTES
============================================================ */

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        $cars = Car::with('images')->where('status', 'available')->limit(4)->get();
        $mobil = Car::with('images')->where('status', 'available')->limit(10)->get();

        // Get all user bookings
        $allBookings = \App\Models\Booking::with('car')->where('user_id', auth()->id())->get();

        // Filter bookings that can be reviewed (completed and no review yet)
        $bookings = $allBookings->filter(function ($booking) {
            return $booking->status === 'completed' && !$booking->reviews()->exists();
        })->values();

        // Check for incomplete bookings
        $incompleteBooking = \App\Models\Booking::where('user_id', auth()->id())
            ->whereNotIn('status', ['completed', 'cancelled', 'rejected', 'expired', 'waiting_cancellation'])
            ->first();

        return view('dashboard', compact('cars', 'mobil', 'bookings', 'incompleteBooking'));
    })->middleware('verified')->name('dashboard');

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Bookings
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::get('/select-dates', [BookingController::class, 'selectDates'])->name('select-dates');
        Route::get('/select-car', function () {
            // Check for incomplete bookings
            $incompleteBooking = \App\Models\Booking::where('user_id', auth()->id())
                ->whereNotIn('status', ['completed', 'cancelled', 'rejected', 'expired', 'waiting_cancellation'])
                ->first();

            return view('bookings.select-car', compact('incompleteBooking'));
        })->name('select-car');
        Route::get('/car-detail/{car}', [BookingController::class, 'showCarDetail'])->name('car-detail');
        Route::get('/create', [BookingController::class, 'create'])->name('create');
        Route::post('/store', [BookingController::class, 'store'])->name('store');
        Route::get('/success/{booking}', [BookingController::class, 'success'])->name('success');
        Route::get('/{booking}', [BookingController::class, 'show'])->name('show');
        Route::post('/{booking}/cancel', [BookingController::class, 'cancel'])->name('cancel');
        Route::get('/{booking}/download', [BookingController::class, 'downloadReceipt'])->name('download');
        Route::post('/{booking}/extend', [BookingExtensionController::class, 'store'])->name('extend');
        Route::post('/{booking}/extend-conflict', [BookingExtensionController::class, 'checkConflict'])->name('extend-conflict');
    });

    // Reviews
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/create', [ReviewController::class, 'create'])->name('create');
        Route::post('/store', [ReviewController::class, 'store'])->name('store');
    });
});

/* ============================================================
   ADMIN ROUTES
============================================================ */

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard & Laporan
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/laporan', [ReportController::class, 'laporan'])->name('laporan');

    // Resources
    Route::resource('car', CarController::class);
    Route::resource('inbox', InboxController::class);
    Route::resource('renter', RenterController::class);
    Route::resource('bank-accounts', BankAccountController::class);
    Route::resource('reviews', AdminReviewController::class)->only(['index', 'destroy']);

    // Booking Cancellation Approval
    Route::post('/bookings/{booking}/approve-cancellation', [BookingController::class, 'approveCancellation'])->name('bookings.approve-cancellation');
    Route::post('/bookings/{booking}/reject-cancellation', [BookingController::class, 'rejectCancellation'])->name('bookings.reject-cancellation');

    // Renter Workflow
    Route::get('/renter/{id}/workflow', [RenterController::class, 'workflow'])->name('renter.workflow');

    // Booking Extensions
    Route::prefix('booking-extensions')->name('booking-extensions.')->group(function () {
        Route::get('/', [BookingExtensionController::class, 'index'])->name('index');
        Route::post('/{extension}/approve', [BookingExtensionController::class, 'approve'])->name('approve');
        Route::post('/{extension}/reject', [BookingExtensionController::class, 'reject'])->name('reject');
    });

    // Booking Checklist & Return
    Route::prefix('booking/{id}')->name('booking.')->group(function () {
        Route::get('/checklist-before', [ReturnController::class, 'beforeChecklistForm'])->name('checklist.before');
        Route::post('/checklist-before', [ReturnController::class, 'submitBeforeChecklist'])->name('checklist.before.submit');
        Route::get('/return', [ReturnController::class, 'returnForm'])->name('return.form');
        Route::post('/return', [ReturnController::class, 'submitReturn'])->name('return.submit');
        Route::get('/penalties', [ReturnController::class, 'showPenalties'])->name('penalties');
        Route::get('/complete', [ReturnController::class, 'completeForm'])->name('complete.form');
        Route::post('/complete', [ReturnController::class, 'completeBooking'])->name('complete');

        // AJAX
        Route::get('/penalties-summary', [ReturnController::class, 'getPenaltiesSummary'])->name('penalties.summary');
        Route::get('/completion-status', [ReturnController::class, 'getCompletionStatus'])->name('completion.status');
    });

    // Penalty
    Route::post('/penalty/{id}/approve', [ReturnController::class, 'approvePenalty'])->name('penalty.approve');
});

/* ============================================================
   AUTH ROUTES
============================================================ */

require __DIR__ . '/auth.php';

/* ============================================================
   STORAGE LINK ROUTE (For cPanel deployment without terminal)
   Access: squadtranswisata.com/create-storage-link
============================================================ */

Route::get('/create-storage-link', function () {
    try {
        // Run the storage:link command
        \Illuminate\Support\Facades\Artisan::call('storage:link');

        return response()->json([
            'success' => true,
            'message' => 'Storage link created successfully!',
            'output' => \Illuminate\Support\Facades\Artisan::output()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
});
