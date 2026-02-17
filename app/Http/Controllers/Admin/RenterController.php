<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Renter; // sesuaikan dengan nama model kamu
use Illuminate\Http\Request;

class RenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::latest();

        // Filter by status if requested
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search by booking code
        if ($request->has('booking_code') && $request->booking_code != '') {
            $query->where('booking_code', 'LIKE', '%' . $request->booking_code . '%');
        }

        // Search by customer name
        if ($request->has('customer_name') && $request->customer_name != '') {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'LIKE', '%' . request('customer_name') . '%');
            });
        }

        // Search by vehicle name
        if ($request->has('vehicle_name') && $request->vehicle_name != '') {
            $query->whereHas('car', function ($q) {
                $q->where('name', 'LIKE', '%' . request('vehicle_name') . '%');
            });
        }

        // Filter by start date
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('start_datetime', '>=', $request->start_date);
        }

        // Filter by end date
        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('end_datetime', '<=', $request->end_date);
        }

        // Use paginate instead of get
        $renters = $query->paginate(10); // 10 items per page

        return view('admin.renter.index', compact('renters'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $renter = Booking::findOrFail($id);

        return view('admin.renter.show', compact('renter'));
    }

    /**
     * Display workflow view for booking
     */
    public function workflow($id)
    {
        $booking = Booking::with(['user', 'car', 'checklists', 'penalties', 'extensions', 'payments','guarantees'])->findOrFail($id);
        // dd($booking->toArray());
        return view('admin.renter.workflow', compact('booking'));
    }

    /**
     * Update status booking (opsional tapi kepake banget buat admin)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,running,completed,cancelled,waiting_penalty,waiting_payment',
        ]);

        $booking = Booking::findOrFail($id);
        $oldStatus = $booking->status;

        $booking->update([
            'status' => $request->status,
        ]);

        if ($request->status === 'confirmed') {
            return redirect()
                ->route('admin.renter.workflow', $id)
                ->with('success', 'Pesanan berhasil disetujui! ✓');
        }

        if ($request->status === 'cancelled') {
            return redirect()
                ->route('admin.renter.workflow', $id)
                ->with('error', 'Pesanan telah dibatalkan.');
        }

        if ($request->status === 'running') {
            // Booking starts
        }

        if ($request->status === 'completed') {
            // Booking completed
        }

        // Untuk status lain, redirect ke show page
        return redirect()
            ->route('admin.renter.show', $id)
            ->with('success', 'Status booking berhasil diperbarui menjadi ' . strtoupper($request->status));
    }

    /**
     * Remove the specified resource.
     */
    public function destroy($id)
    {
        $renter = Booking::findOrFail($id);
        $renter->delete();

        return redirect()
            ->route('admin.renter.index')
            ->with('success', 'Data booking berhasil dihapus');
    }
}
