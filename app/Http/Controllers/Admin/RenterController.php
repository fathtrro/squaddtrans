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

        // Search by booking code or customer name
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('booking_code', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhereHas('user', function ($subQ) use ($searchTerm) {
                      $subQ->where('name', 'LIKE', '%' . $searchTerm . '%');
                  });
            });
        }

        // Filter by date range
        if ($request->has('date_range') && $request->date_range != '') {
            $today = now()->startOfDay();

            switch ($request->date_range) {
                case 'today':
                    $query->whereDate('start_datetime', $today);
                    break;
                case '7days':
                    $query->whereBetween('start_datetime', [
                        $today->copy()->subDays(7),
                        $today->copy()->addDay()
                    ]);
                    break;
                case '30days':
                    $query->whereBetween('start_datetime', [
                        $today->copy()->subDays(30),
                        $today->copy()->addDay()
                    ]);
                    break;
                case 'this_month':
                    $query->whereYear('start_datetime', $today->year)
                          ->whereMonth('start_datetime', $today->month);
                    break;
            }
        }

        // Get all bookings count
        $allBookings = Booking::count();

        // Paginate results
        $renters = $query->paginate(10);

        return view('admin.renter.index', compact('renters', 'allBookings'));
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
