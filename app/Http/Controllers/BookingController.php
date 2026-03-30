<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BankAccount;
use App\Models\Guarantee;
use App\Models\Payment;
use App\Models\Car;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Show date selection form
     */
    public function selectDates()
    {
        return view('bookings.select-dates');
    }

    /**
     * Show car detail page for booking
     */
    public function showCarDetail(Request $request, Car $car)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        // Validate dates
        $request->validate([
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after:start_date',
        ]);

        // Calculate duration
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $duration = $start->diffInDays($end) + 1;

        // Get daily price (use price_24h)
        $dailyPrice = $car->price_24h;

        // Check if car is available for these dates
        $isAvailable = !Booking::where('car_id', $car->id)
            ->whereIn('status', ['confirmed', 'running', 'pending'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('start_datetime', '<', $endDate . ' 23:59:59')
                      ->where('end_datetime', '>', $startDate . ' 00:00:00');
            })
            ->exists();

        // Get reviews for this car
        $reviews = $car->reviews()->with('user')->latest()->get();
        $averageRating = $reviews->avg('rating') ?? 0;
        $reviewCount = $reviews->count();

        return view('bookings.car-detail', [
            'car' => $car->load('images'),
            'startDate' => $startDate,
            'endDate' => $endDate,
            'duration' => $duration,
            'dailyPrice' => $dailyPrice,
            'isAvailable' => $isAvailable,
            'reviews' => $reviews,
            'averageRating' => $averageRating,
            'reviewCount' => $reviewCount,
        ]);
    }

    /**
     * Get available cars for selected dates via AJAX
     */
    public function getAvailableCars(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after:start_date',
        ]);

        $startDate = $request->start_date . ' 00:00:00';
        $endDate = $request->end_date . ' 23:59:59';

        // Get all cars with their images
        $cars = Car::with('images')
            ->where('status', 'available')
            ->get()
            ->map(function ($car) use ($startDate, $endDate) {
                // Check if this car has any conflicting bookings
                $hasConflict = Booking::where('car_id', $car->id)
                    ->whereIn('status', ['confirmed', 'running', 'pending'])
                    ->where(function ($query) use ($startDate, $endDate) {
                        $query->where('start_datetime', '<', $endDate)
                              ->where('end_datetime', '>', $startDate);
                    })
                    ->exists();

                $car->is_available = !$hasConflict;
                $car->main_image_url = $car->images->first()
                    ? asset('storage/' . $car->images->first()->image_path)
                    : asset('images/default-car.png');

                // Map field names for frontend compatibility
                $car->car_plate = $car->plate_number;
                $car->number_of_seats = $car->seats;
                $car->daily_rent_price = $car->price_24h;
                $car->engine_capacity = '1.5L'; // Default value since not in database

                return $car;
            });

        return response()->json([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'cars' => $cars,
        ]);
    }

    public function create(Request $request)
    {
        // Prevent access to create page if user just booked
        if (session('just_booked')) {
            return redirect()->route('cars.index')->with('info', 'Anda baru saja melakukan booking. Silakan pilih mobil lain jika diperlukan.');
        }

        $car = null;
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if ($request->filled('car')) {
            $car = Car::with('images')->find($request->query('car'));
        }

        return view('bookings.create', [
            'cars' => Car::all(),
            'drivers' => Driver::all(),
            'bankAccounts' => BankAccount::where('is_active', true)->get(),
            'car' => $car,
            'selectedServiceType' => $request->query('service_type'),
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    // API endpoint to check booked dates for a car
    public function checkBookedDates(Request $request)
    {
        $carId = $request->query('car_id');

        if (!$carId) {
            return response()->json(['error' => 'Car ID required'], 400);
        }

        // Get all confirmed/running bookings for this car
        $bookedDates = Booking::where('car_id', $carId)
            ->whereIn('status', ['confirmed', 'running'])
            ->selectRaw('DATE(start_datetime) as start_date, DATE(end_datetime) as end_date')
            ->get();

        return response()->json([
            'booked_dates' => $bookedDates
        ]);
    }

    public function store(Request $request)
    {
        // Allow destination to be optional (users may skip). If frontend passes min_deposit,
        // enforce amount >= min_deposit where applicable.
        $rules = [
            'car_id' => 'required|exists:cars,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'service_type' => 'required|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'destination' => 'nullable|string',
            'contact' => 'required|string|max:20',
            'alamat' => 'required|string',
            'total_price' => 'required|numeric',
            'guarantee_type' => 'required|string',
            'document_file' => 'required|file|mimes:jpg,png,pdf',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'selected_bank' => 'required|exists:bank_accounts,id',
            'proof_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];

        $validated = $request->validate($rules);

        // Check for overlapping bookings
        $existingBooking = Booking::where('car_id', $request->car_id)
            ->whereIn('status', ['confirmed', 'running', 'pending'])
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('start_datetime', '<', $request->end_datetime)
                      ->where('end_datetime', '>', $request->start_datetime);
                });
            })
            ->exists();

        if ($existingBooking) {
            return back()->withErrors(['start_datetime' => 'Mobil ini sudah dipesan untuk tanggal tersebut. Silakan pilih tanggal lain.'])->withInput();
        }

        // If frontend provided a minimum deposit, validate amount meets it
        if ($request->filled('min_deposit')) {
            $min = (float) $request->min_deposit;
            if ((float) $request->amount < $min) {
                return back()->withErrors(['amount' => "DP harus minimal Rp " . number_format($min, 0, ',', '.')])->withInput();
            }
        }

        $booking = null;

        DB::transaction(function () use ($request, &$booking) {

            // BOOKING
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'car_id' => $request->car_id,
                'driver_id' => $request->driver_id,
                'service_type' => $request->service_type,
                'start_datetime' => $request->start_datetime,
                'end_datetime' => $request->end_datetime,
                'destination' => $request->destination,
                'contact' => $request->contact,
                'alamat' => $request->alamat,
                'dp_amount' => $request->amount,
                'total_price' => $request->total_price,
                'status' => 'pending',
            ]);

            // BOOKING CODE
            $booking->update([
                'booking_code' => 'BK-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT)
            ]);

            // GUARANTEE
            $filePath = $request->file('document_file')
                ->store('guarantees', 'public');

            Guarantee::create([
                'booking_id' => $booking->id,
                'type' => $request->guarantee_type,
                'document_file' => $filePath,
            ]);

            // ✅ TAMBAHKAN: Upload proof image jika ada
            $proofImagePath = null;
            if ($request->hasFile('proof_image')) {
                $proofImagePath = $request->file('proof_image')
                    ->store('payment_proofs', 'public');
            }

            // PAYMENT
            Payment::create([
                'booking_id' => $booking->id,
                'payment_type' => 'dp',
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'bank_id' => $request->selected_bank,
                'proof_image' => $proofImagePath, // ✅ SIMPAN PATH BUKTI
                'status' => 'pending',
            ]);
        });


        return redirect()->route('bookings.success', $booking->id);
    }

    public function success(Booking $booking)
    {
        $booking->load(['car', 'user', 'payments']);

        // Set session to indicate user just booked
        session(['just_booked' => true]);

        return view('bookings.success', compact('booking'));
    }

    public function index(Request $request)
    {
        $query = Booking::with(['user', 'car', 'payments.bankAccount'])
            ->where('user_id', auth()->id());

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_filter')) {
            $query->whereDate('start_datetime', $request->date_filter);
        }
        $allBookings = (clone $query)->get();
        $bookings = $query->latest()->paginate(3);

        return view('bookings.index', [
            'bookings' => $bookings,
            'allBookings' => $allBookings
        ]);
    }

    public function show($id)
    {
        $booking = Booking::with([
            'car',
            'driver',
            'payments',
            'guarantees',
            'extensions',
            'user'
        ])->findOrFail($id);

        return view('bookings.show', compact('booking'));
    }

    /**
     * Cancel a booking
     */
    public function cancel(Request $request, Booking $booking)
    {
        // Validate that the user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate that booking can be cancelled
        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return redirect()->back()->with('error', 'Booking tidak dapat dibatalkan pada status saat ini.');
        }

        // Validate cancellation reason
        $request->validate([
            'cancellation_reason' => 'required|string|max:1000'
        ]);

        // Update booking status and cancellation reason
        $booking->update([
            'status' => 'cancelled',
            'cancellation_reason' => $request->cancellation_reason
        ]);

        return redirect()->back()->with('success', 'Booking berhasil dibatalkan.');
    }

    /**
     * Download bukti pembayaran PDF
     */
    public function downloadReceipt($id)
    {
        $booking = Booking::with([
            'car',
            'driver',
            'payments',
            'guarantees',
            'user'
        ])->findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $pdf = Pdf::loadView('bookings.receipt', compact('booking'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Bukti-Pembayaran-' . $booking->booking_code . '.pdf');
    }
}
