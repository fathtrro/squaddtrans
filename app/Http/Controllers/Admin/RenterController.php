<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Car;
use App\Models\Driver;
use App\Traits\SendsWhatsAppNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RenterController extends Controller
{
    use SendsWhatsAppNotifications;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'customer')->get();
        $cars = Car::where('status', 'available')->get();
        $drivers = Driver::all();

        return view('admin.renter.create', compact('users', 'cars', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'service_type' => 'required|in:with_driver,without_driver,self_drive',
            'start_datetime' => 'required|date_format:Y-m-d\TH:i',
            'end_datetime' => 'required|date_format:Y-m-d\TH:i|after:start_datetime',
            'destination' => 'nullable|string',
            'contact' => 'nullable|string',
            'alamat' => 'nullable|string',
            'dp_amount' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,running,completed,cancelled',
        ]);

        $booking = Booking::create($validated);

        return redirect()
            ->route('admin.renter.show', $booking->id)
            ->with('success', 'Penyewa berhasil ditambahkan! ✓');
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
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $users = User::where('role', 'customer')->get();
        $cars = Car::all();
        $drivers = Driver::all();

        return view('admin.renter.edit', compact('booking', 'users', 'cars', 'drivers'));
    }

    /**
     * Update status booking (opsional tapi kepake banget buat admin)
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // If the request contains a 'status' field only, update only status
        // (exclude _token and _method from count checks, because FormMethod patch adds _method)
        $payload = $request->except(['_token', '_method']);
        if ($request->has('status') && count($payload) === 1) {
            $request->validate([
                'status' => 'required|in:pending,confirmed,running,completed,cancelled,waiting_penalty,waiting_payment',
            ]);

            $booking->update([
                'status' => $request->status,
            ]);

            if ($request->status === 'confirmed') {
                // Kirim notifikasi WA via Fonnte dengan pesan yang lebih detail
                $target = $booking->contact ?? ($booking->user->phone ?? null);
                $confirmMessage = "✅ *Pesanan Anda Telah Disetujui!*\n\n" .
                    "Halo " . ($booking->user->name ?? 'Pelanggan') . ",\n\n" .
                    "Pesanan penyewaan mobil Anda dengan kode *" . $booking->booking_code . "* telah disetujui! 🎉\n\n" .
                    "🚗 *Detail Kendaraan:*\n" .
                    "Mobil: " . $booking->car->brand . " " . $booking->car->name . "\n" .
                    "Plat: " . $booking->car->plate_number . "\n\n" .
                    "📅 *Jadwal Penyewaan:*\n" .
                    "Mulai: " . $booking->start_datetime->format('d M Y, H:i') . "\n" .
                    "Selesai: " . $booking->end_datetime->format('d M Y, H:i') . "\n\n" .
                    "💰 *Biaya Sewa:*\n" .
                    "Total: Rp " . number_format($booking->total_price, 0, ',', '.') . "\n" .
                    "DP Dibayar: Rp " . number_format($booking->dp_amount, 0, ',', '.') . "\n" .
                    "Sisa: Rp " . number_format($booking->total_price - $booking->dp_amount, 0, ',', '.') . "\n\n" .
                    "📍 *Langkah Selanjutnya:*\n" .
                    "✓ Silahkan melakukan pelunasan pembayaran\n" .
                    "✓ Lalu lakukan pengambilan unit di lokasi kami\n\n" .
                    "📞 Hubungi kami untuk info lebih lanjut: " . env('ADMIN_PHONE', '+62 812-3328-3578') . "\n\n" .
                    "Terima kasih! 🙏";

                $this->sendFonnteWhatsApp($target, $confirmMessage);

                return redirect()
                    ->route('admin.renter.workflow', $id)
                    ->with('success', 'Pesanan berhasil disetujui! ✓');
            }

            if ($request->status === 'cancelled') {
                return redirect()
                    ->route('admin.renter.workflow', $id)
                    ->with('error', 'Pesanan telah dibatalkan.');
            }

            return redirect()
                ->route('admin.renter.show', $id)
                ->with('success', 'Status booking berhasil diperbarui menjadi ' . strtoupper($request->status));
        }

        // Otherwise, update all fields
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_datetime' => 'required|date_format:Y-m-d\TH:i',
            'end_datetime' => 'required|date_format:Y-m-d\TH:i|after:start_datetime',
            'destination' => 'nullable|string',
            'contact' => 'nullable|string',
            'alamat' => 'nullable|string',
            'dp_amount' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,running,completed,cancelled,waiting_cancellation,approved,rejected,waiting_penalty,waiting_payment,expired',
        ]);

        $booking->update($validated);

        return redirect()
            ->route('admin.renter.show', $id)
            ->with('success', 'Data penyewa berhasil diperbarui! ✓');
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
