<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guarantee;
use App\Models\Payment;
use App\Models\Car;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $car = null;

        if ($request->filled('car')) {
            $car = Car::with('images')->find($request->query('car'));
        }

        return view('bookings.create', [
            'cars' => Car::all(),
            'drivers' => Driver::all(),
            'car' => $car,
            'selectedServiceType' => $request->query('service_type'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'service_type' => 'required|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'destination' => 'required|string',
            'contact' => 'required|string|max:20',
            'alamat' => 'required|string',
            'total_price' => 'required|numeric',
            'guarantee_type' => 'required|string',
            'document_file' => 'required|file|mimes:jpg,png,pdf',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'proof_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // ✅ TAMBAHKAN INI
        ]);

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
                'proof_image' => $proofImagePath, // ✅ SIMPAN PATH BUKTI
                'status' => 'pending',
            ]);
        });

        return redirect()->route('bookings.success', $booking->id);
    }

    public function success(Booking $booking)
    {
        $booking->load(['car', 'user', 'payments']);

        return view('bookings.success', compact('booking'));
    }

    public function index(Request $request)
    {
        $query = Booking::with(['car', 'payments'])
            ->where('user_id', auth()->id());

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_filter')) {
            $query->whereDate('start_datetime', $request->date_filter);
        }

        $allBookings = (clone $query)->get();
        $bookings = $query->latest()->paginate(10);
        // dd($allBookings->toArray());
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
