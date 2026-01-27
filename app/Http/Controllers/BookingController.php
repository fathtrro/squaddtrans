<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guarantee;
use App\Models\Payment;
use App\Models\Car;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::transaction(function () use ($request) {

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


            /** GUARANTEE */
            $filePath = $request->file('document_file')
                ->store('guarantees', 'public');

            Guarantee::create([
                'booking_id' => $booking->id,
                'type' => $request->guarantee_type,
                'document_file' => $filePath,
            ]);

            /** PAYMENT (DP) */
            Payment::create([
                'booking_id' => $booking->id,
                'payment_type' => 'dp',
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);
        });

        return redirect()->route('bookings.success');
    }

    public function success()
    {
        return view('bookings.success');
    }

    public function index()
    {
        $bookings = Booking::with(['car', 'payments'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('bookings.index', compact('bookings'));
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


}
