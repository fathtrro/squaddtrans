<?php



namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Driver;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function create(Car $car)
    {
        // Debug log
        Log::info('Booking create page accessed', ['car_id' => $car->id]);

        // Check if car is available
        if ($car->status !== 'available') {
            return redirect()->route('cars.index')
                ->with('error', 'Mobil ini sedang tidak tersedia.');
        }

        $drivers = Driver::where('status', 'available')->get();

        return view('bookings.create', compact('car', 'drivers'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'service_type' => 'required|in:lepas_kunci,dengan_sopir,carter',
            'start_datetime' => 'required|date|after:now',
            'end_datetime' => 'required|date|after:start_datetime',
            'destination' => 'nullable|string|max:255',
            'driver_id' => 'required_if:service_type,dengan_sopir,carter|nullable|exists:drivers,id',
        ]);

        try {
            DB::beginTransaction();

            $car = Car::findOrFail($validated['car_id']);

            // Calculate duration and total price
            $startDate = Carbon::parse($validated['start_datetime']);
            $endDate = Carbon::parse($validated['end_datetime']);
            $durationDays = $startDate->diffInDays($endDate) ?: 1;

            // Get base price based on service type
            $basePrice = $car->price_24h;

            if ($validated['service_type'] === 'dengan_sopir') {
                $basePrice = $car->price_with_driver ?? ($car->price_24h + 200000);
            } elseif ($validated['service_type'] === 'carter') {
                $basePrice = $car->price_carter ?? ($car->price_24h + 500000);
            }

            $totalPrice = $basePrice * $durationDays;
            $dpAmount = $totalPrice * 0.3; // 30% DP

            // Create booking
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'car_id' => $validated['car_id'],
                'driver_id' => $validated['driver_id'] ?? null,
                'service_type' => $validated['service_type'],
                'start_datetime' => $validated['start_datetime'],
                'end_datetime' => $validated['end_datetime'],
                'destination' => $validated['destination'],
                'dp_amount' => $dpAmount,
                'total_price' => $totalPrice,
                'status' => 'pending', // PASTIKAN INI ADA
            ]);

            // Update car status
            $car->update(['status' => 'booked']);

            // Update driver status if applicable
            if ($validated['driver_id']) {
                Driver::find($validated['driver_id'])->update(['status' => 'booked']);
            }

            DB::commit();

            // Log untuk debug
            \Log::info('Booking created', [
                'booking_id' => $booking->id,
                'status' => $booking->status,
                'total_price' => $booking->total_price,
                'dp_amount' => $booking->dp_amount
            ]);

            return redirect()->route('bookings.show', $booking)
                ->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran DP.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Booking creation failed', ['error' => $e->getMessage()]);
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat membuat booking: ' . $e->getMessage());
        }
    }

    public function show(Booking $booking)
    {
        // Ensure user can only view their own bookings
        if ($booking->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $booking->load(['car', 'driver', 'user']);

        return view('bookings.show', compact('booking'));
    }

    public function index()
    {
        $bookings = Booking::with(['car', 'driver'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'Booking ini tidak dapat dibatalkan.');
        }

        try {
            DB::beginTransaction();

            $booking->update(['status' => 'cancelled']);
            $booking->car->update(['status' => 'available']);

            if ($booking->driver_id) {
                $booking->driver->update(['status' => 'available']);
            }

            DB::commit();

            return back()->with('success', 'Booking berhasil dibatalkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membatalkan booking.');
        }
    }

    public function calculatePrice(Request $request)
    {
        $car = Car::find($request->car_id);
        $startDate = Carbon::parse($request->start_datetime);
        $endDate = Carbon::parse($request->end_datetime);
        $durationDays = $startDate->diffInDays($endDate) ?: 1;

        $basePrice = $car->price_24h;

        if ($request->service_type === 'dengan_sopir') {
            $basePrice = $car->price_with_driver ?? ($car->price_24h + 200000);
        } elseif ($request->service_type === 'carter') {
            $basePrice = $car->price_carter ?? ($car->price_24h + 500000);
        }

        $totalPrice = $basePrice * $durationDays;
        $dpAmount = $totalPrice * 0.3;

        return response()->json([
            'duration_days' => $durationDays,
            'base_price' => $basePrice,
            'total_price' => $totalPrice,
            'dp_amount' => $dpAmount,
            'formatted_total' => 'Rp ' . number_format($totalPrice, 0, ',', '.'),
            'formatted_dp' => 'Rp ' . number_format($dpAmount, 0, ',', '.'),
        ]);
    }
}
