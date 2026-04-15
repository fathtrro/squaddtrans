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
        // Check if user has active bookings
        $activeBooking = null;
        if (auth()->check()) {
            $activeBooking = Booking::where('user_id', auth()->id())
                ->whereNotIn('status', ['completed', 'cancelled'])
                ->first();
        }
        
        return view('bookings.select-dates', compact('activeBooking'));
    }

    /**
     * Show car detail page for booking
     */
    public function showCarDetail(Request $request, Car $car)
    {
        // Check if user has active bookings (status not COMPLETED or CANCELLED)
        if (auth()->check()) {
            $activeBooking = Booking::where('user_id', auth()->id())
                ->whereNotIn('status', ['completed', 'cancelled'])
                ->first();
            
            if ($activeBooking) {
                return back()->with('error', 'Anda tidak bisa melakukan booking baru. Selesaikan atau batalkan booking sebelumnya terlebih dahulu. Booking aktif Anda: ' . $activeBooking->booking_code);
            }
        }

        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        // Validate dates
        $request->validate([
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
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
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
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
                // Use category from database as car type label
                $car->engine_capacity = $car->category ?? 'Unknown';

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
        // Check if user has active bookings (status not COMPLETED or CANCELLED)
        $activeBooking = Booking::where('user_id', auth()->id())
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->first();

        if ($activeBooking) {
            return back()->with('error', 'Anda tidak bisa melakukan booking baru. Selesaikan atau batalkan booking sebelumnya terlebih dahulu. Booking aktif Anda: ' . $activeBooking->booking_code)->withInput();
        }

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

        // Send WhatsApp notifications via Fonnte API
        $this->sendNewBookingNotifications($booking, $request);

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
     * Send WhatsApp notifications for new booking
     */
    private function sendNewBookingNotifications(Booking $booking, Request $request)
    {
        $booking->load(['car', 'user', 'payments.bankAccount']);

        // Format dates
        $startDate = Carbon::parse($booking->start_datetime)->format('D, d M Y H:i');
        $endDate = Carbon::parse($booking->end_datetime)->format('D, d M Y H:i');
        $durationDays = $booking->start_datetime->diffInDays($booking->end_datetime) + 1;

        // Billing info
        $guaranteeType = $request->guarantee_type;
        $paymentMethod = $request->payment_method;
        $bankAccount = $request->selected_bank ? 
            \App\Models\BankAccount::find($request->selected_bank) : null;
        $bankInfo = $bankAccount ? 
            $bankAccount->bank_name . ' - ' . $bankAccount->account_number . ' (a.n. ' . $bankAccount->account_holder . ')' : 
            'N/A';

        // ==========================================
        // MESSAGE TO ADMIN
        // ==========================================
        $adminMessage = "📋 *BOOKING BARU MASUK*\n\n" .
            "🚗 Kode Booking: *" . $booking->booking_code . "*\n" .
            "Mobil: " . $booking->car->brand . " " . $booking->car->name . " (" . ucfirst($request->service_type) . ")\n\n" .
            "📅 *JADWAL SEWA*\n" .
            "🕐 Mulai: " . $startDate . "\n" .
            "🏁 Selesai: " . $endDate . "\n" .
            "📆 Durasi: " . $durationDays . " Hari\n\n" .
            "👤 *DATA PENYEWA*\n" .
            "📱 Kontak: " . $booking->contact . "\n" .
            "📍 Alamat: " . $booking->alamat . "\n" .
            "🗺️ Tujuan: " . ($booking->destination ?? '-') . "\n\n" .
            "🛡️ *JAMINAN*\n" .
            "Tipe: " . $guaranteeType . "\n" .
            "💳 *PEMBAYARAN*\n" .
            "Metode: " . $paymentMethod . "\n" .
            "Bank: " . $bankInfo . "\n" .
            "Total Harga: Rp " . number_format($booking->total_price, 0, ',', '.') . "\n" .
            "DP Dibayar: Rp " . number_format($booking->dp_amount, 0, ',', '.') . "\n" .
            "Sisa Bayar: Rp " . number_format($booking->total_price - $booking->dp_amount, 0, ',', '.') . "\n\n" .
            "⚡ *SEGERA PROSES DI WEB*\n" .
            "Periksa dokumen, foto, dan bukti transfer";

        $this->sendFonnteWhatsApp(env('ADMIN_PHONE', null), $adminMessage);

        // ==========================================
        // MESSAGE TO USER
        // ==========================================
        $userMessage = "⏳ *PEMESANAN DIPROSES*\n\n" .
            "Terima kasih telah mempercayai SQUADTRANS!\n\n" .
            "🎫 Kode Booking: *" . $booking->booking_code . "*\n" .
            "🚗 Mobil: " . $booking->car->brand . " " . $booking->car->name . "\n\n" .
            "📅 *JADWAL SEWA ANDA*\n" .
            "🕐 Mulai: " . $startDate . "\n" .
            "🏁 Selesai: " . $endDate . "\n" .
            "📆 Durasi: " . $durationDays . " Hari\n\n" .
            "💰 *RINCIAN PEMBAYARAN*\n" .
            "Total: Rp " . number_format($booking->total_price, 0, ',', '.') . "\n" .
            "DP/Bayar: Rp " . number_format($booking->dp_amount, 0, ',', '.') . "\n" .
            "Sisa: Rp " . number_format($booking->total_price - $booking->dp_amount, 0, ',', '.') . "\n\n" .
            "⏳ *STATUS*\n" .
            "Admin sedang memverifikasi data Anda\n" .
            "Kami akan menghubungi dalam waktu 1-2 jam\n\n" .
            "❓ Ada pertanyaan? Hubungi +62 812-3328-3578\n" .
            "atau balas pesan ini";

        $this->sendFonnteWhatsApp($booking->contact ?? $booking->user->phone, $userMessage);
    }

    /**
     * Cancel a booking (send notification to admin via Fonnte)
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

        // Update booking status to waiting_cancellation (admin must approve)
        $booking->update([
            'status' => 'waiting_cancellation',
            'cancellation_reason' => $request->cancellation_reason
        ]);

        // Send WhatsApp notification to admin via Fonnte
        $adminMessage = "📋 *PERMINTAAN PEMBATALAN BOOKING*

" .
            "🚗 Kode Booking: *" . $booking->booking_code . "*
" .
            "👤 Pengemudi: " . ($booking->user->name ?? 'N/A') . "
" .
            "📱 Kontak: " . $booking->contact . "
" .
            "🚙 Mobil: " . ($booking->car->name ?? 'N/A') . "
" .
            "📅 Tanggal: " . $booking->start_datetime->format('d M Y H:i') . " - " . $booking->end_datetime->format('d M Y H:i') . "
" .
            "💰 Total: Rp " . number_format($booking->total_price, 0, ',', '.') . "
" .
            "⏳ Status: *MENUNGGU KONFIRMASI*
" .
            "\n⚠️ Silakan segera lakukan konfirmasi (Setujui/Tolak)";
        $this->sendFonnteWhatsApp(env('ADMIN_PHONE', null), $adminMessage);

        // Send WhatsApp notification to user (renter) via Fonnte
        $userPhone = $booking->contact ?? $booking->user->phone;
        if (!empty($userPhone)) {
            $userMessage = "⏳ *Permintaan Pembatalan Diproses*
" .
                "\nKode Booking: *" . $booking->booking_code . "*
" .
                "Mobil: " . ($booking->car->name ?? 'N/A') . "
" .
                "\n⏳ Admin akan memproses dalam waktu singkat
" .
                "Kami akan notifikasi Anda saat ada update terbaru"
                ;
            $this->sendFonnteWhatsApp($userPhone, $userMessage);
        }

        return redirect()->back()->with('success', 'Permintaan pembatalan telah dikirim. Admin akan memprosesnya.');
    }

    /**
     * Approve cancellation request (Admin only) - Send notification to renter and admin
     */
    public function approveCancellation(Booking $booking)
    {
        // Check if user is admin
        if ($this->isNotAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if booking has pending cancellation request
        if ($booking->status !== 'waiting_cancellation') {
            return redirect()->back()->with('error', 'Tidak ada permintaan pembatalan untuk booking ini.');
        }

        // Update booking status to cancelled and record who approved it
        $booking->update([
            'status' => 'cancelled',
            'cancellation_approved_by' => auth()->id()
        ]);

        // Send WhatsApp notification to renter via Fonnte
        $renterPhone = $booking->contact ?? $booking->user->phone;
        if (!empty($renterPhone)) {
            $renterMessage = "✅ *PEMBATALAN DISETUJUI*
" .
                "\n🎉 Permintaan pembatalan Anda telah disetujui
" .
                "Kode Booking: *" . $booking->booking_code . "*
" .
                "\n📌 Informasi Pengembalian:
" .
                "📍 Lokasi: " . ($booking->alamat ?? 'Sesuai kesepakatan') . "
" .
                "🕐 Status: DIBATALKAN
" .
                "\n💵 Dana akan diproses sesuai kebijakan
" .
                "\n📞 Hubungi kami +62 812-3328-3578 jika ada pertanyaan"
                ;
            $this->sendFonnteWhatsApp($renterPhone, $renterMessage);
        } else {
            logger()->warning('Renter phone not found for booking #' . $booking->booking_code);
        }

        // Send WhatsApp notification to admin
        $adminMessage = "✅ *PEMBATALAN DISETUJUI*
" .
            "\n🚗 Kode Booking: *" . $booking->booking_code . "*
" .
            "👤 Pengemudi: " . ($booking->user->name ?? 'N/A') . "
" .
            "📱 Kontak: " . $booking->contact . "
" .
            "📅 Tanggal: " . now()->format('d M Y H:i:s') . "
" .
            "🔄 Status: DIBATALKAN
" .
            "\n✨ Proses selesai. Data sudah tersimpan dalam sistem";
        $this->sendFonnteWhatsApp(env('ADMIN_PHONE', null), $adminMessage);

        return redirect()->back()->with('success', 'Permintaan pembatalan booking telah disetujui.');
    }

    /**
     * Reject cancellation request (Admin only) - Send notification to renter and admin
     */
    public function rejectCancellation(Request $request, Booking $booking)
    {
        // Check if user is admin
        if ($this->isNotAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if booking has pending cancellation request
        if ($booking->status !== 'waiting_cancellation') {
            return redirect()->back()->with('error', 'Tidak ada permintaan pembatalan untuk booking ini.');
        }

        // Revert status back to pending
        $booking->update([
            'status' => 'pending',
            'cancellation_reason' => null,
            'cancellation_requested_at' => null,
            'cancellation_approved_by' => null
        ]);

        // Send WhatsApp notification to renter via Fonnte
        $renterPhone = $booking->contact ?? $booking->user->phone;
        if (!empty($renterPhone)) {
            $rejectionMessage = "❌ *PEMBATALAN DITOLAK*
" .
                "\nPermintaan pembatalan Anda telah ditolak oleh admin
" .
                "Kode Booking: *" . $booking->booking_code . "*
" .
                "\n📌 Mohon Lanjutkan:
" .
                "🚙 Booking Anda masih berlaku
" .
                "📅 Tanggal: " . $booking->start_datetime->format('d M Y') . " - " . $booking->end_datetime->format('d M Y') . "
" .
                "\n📞 Hubungi admin berikut +62 812-3328-3578 jika ada kendala atau pertanyaan lebih lanjut"
                ;
            $this->sendFonnteWhatsApp($renterPhone, $rejectionMessage);
        } else {
            logger()->warning('Renter phone not found for booking #' . $booking->booking_code);
        }

        // Send WhatsApp notification to admin
        $adminMessage = "❌ *PEMBATALAN DITOLAK*
" .
            "\n🚗 Kode Booking: *" . $booking->booking_code . "*
" .
            "👤 Pengemudi: " . ($booking->user->name ?? 'N/A') . "
" .
            "📱 Kontak: " . $booking->contact . "
" .
            "📅 Tanggal: " . now()->format('d M Y H:i:s') . "
" .
            "🔄 Status: DITOLAK - Kembali ke PENDING
" .
            "\n✨ Pengemudi akan melanjutkan proses rental";
        $this->sendFonnteWhatsApp(env('ADMIN_PHONE', null), $adminMessage);

        return redirect()->back()->with('success', 'Permintaan pembatalan booking telah ditolak.');
    }

    /**
     * Check if user is admin
     */
    private function isNotAdmin()
    {
        return !auth()->check() || auth()->user()->role !== 'admin';
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
