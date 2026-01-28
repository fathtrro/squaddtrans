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
     * Update status booking (opsional tapi kepake banget buat admin)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,running,completed,cancelled',
        ]);

        $booking = Booking::findOrFail($id);

        $booking->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.renter.index')
            ->with('success', 'Status booking berhasil diperbarui');
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
