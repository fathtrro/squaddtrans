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
        return view('bookings.create', [
            'cars' => Car::all(),
            'drivers' => Driver::all(),
            'selectedCarId' => $request->query('car'),
            'selectedServiceType' => $request->query('service_type'),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'service_type' => 'required',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'total_price' => 'required|numeric',
            'guarantee_type' => 'required',
            'document_file' => 'required|file|mimes:jpg,png,pdf',
            'amount' => 'required|numeric|min:0',
        ]);

        $booking = null; // ⬅️ penting

        DB::transaction(function () use ($request, &$booking) {

            $booking = Booking::create([
                'user_id' => auth()->id(),
                'car_id' => $request->car_id,
                'driver_id' => $request->driver_id,
                'service_type' => $request->service_type,
                'start_datetime' => $request->start_datetime,
                'end_datetime' => $request->end_datetime,
                'destination' => $request->destination,
                'dp_amount' => $request->amount,
                'total_price' => $request->total_price,
                'status' => 'pending',
            ]);

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

            // PAYMENT
            Payment::create([
                'booking_id' => $booking->id,
                'payment_type' => 'dp',
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
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

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->filled('date_filter')) {
            $query->whereDate('start_datetime', $request->date_filter);
        }

        // Get all bookings for stats (before pagination)
        $allBookings = (clone $query)->get();

        // Apply pagination
        $bookings = $query->latest()->paginate(10);

        return view('bookings.index', [
            'bookings' => $bookings,
            'allBookings' => $allBookings // For stats calculation
        ]);
    }


    public function show($id)
    {
        $booking = Booking::with([
            'car',
            'driver',
            'payments',
            'guarantees'
        ])->findOrFail($id);

        return view('bookings.show', compact('booking'));
    }

    /**
     * Download bukti pembayaran sebagai PDF
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

        // Pastikan booking milik user yang sedang login
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Generate PDF
        $pdf = Pdf::loadView('bookings.receipt', compact('booking'))
            ->setPaper('a4', 'portrait');

        // Download dengan nama file yang sesuai
        return $pdf->download('Bukti-Pembayaran-' . $booking->booking_code . '.pdf');
    }
}
