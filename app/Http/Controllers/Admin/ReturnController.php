<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubmitReturnRequest;
use App\Http\Requests\Admin\ApprovePenaltyRequest;
use App\Http\Requests\Admin\CompleteBookingRequest;
use App\Models\Booking;
use App\Models\Penalty;
use App\Services\ReturnBookingService;
use App\Services\BookingCompletionService;
use App\Services\PenaltyManagementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReturnController extends Controller
{
    /**
     * Inject services
     */
    protected $returnBookingService;
    protected $completionService;
    protected $penaltyService;

    public function __construct(
        ReturnBookingService $returnBookingService,
        BookingCompletionService $completionService,
        PenaltyManagementService $penaltyService
    ) {
        $this->returnBookingService = $returnBookingService;
        $this->completionService = $completionService;
        $this->penaltyService = $penaltyService;
    }

    /**
     * Show return form for a booking
     * GET /admin/booking/{id}/return
     */
    public function returnForm($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Check if can return
        if (!$this->returnBookingService->canReturn($booking)) {
            return redirect()->route('admin.renter.show', $booking->id)
                ->with('error', 'Booking harus dalam status "Sedang Berjalan" dan sudah memiliki checklist sebelum untuk melakukan return.');
        }

        // Get before checklist for reference
        $beforeChecklist = $booking->getBeforeChecklist();

        return view('admin.return.form', compact('booking', 'beforeChecklist'));
    }

    /**
     * Submit return for a booking
     * POST /admin/booking/{id}/return
     */
    public function submitReturn(SubmitReturnRequest $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Validate can return
        if (!$this->returnBookingService->canReturn($booking)) {
            return redirect()->route('admin.renter.show', $booking->id)
                ->with('error', 'Tidak dapat melakukan return untuk booking ini.');
        }

        // Prepare data
        $data = $request->validated();
        $photos = $this->extractPhotosFromRequest($request);

        // Submit return
        $result = $this->returnBookingService->submitReturn($booking, $data, $photos);

        if (!$result['success']) {
            return redirect()->back()
                ->with('error', $result['message'])
                ->withInput();
        }



        // Determine success message
        $message = $result['message'];
        $redirectRoute = !$result['penalties']->isEmpty()
            ? 'admin.penalty.index'
            : 'admin.renter.show';

        // Send WA notification for return checklist
        try {
            $target = $booking->contact ?? $booking->user->phone ?? null;
            if ($target) {
                $target = preg_replace('/[^0-9+]/', '', $target);
                if (str_starts_with($target, '0')) {
                    $target = '62' . substr($target, 1);
                } elseif (str_starts_with($target, '+')) {
                    $target = substr($target, 1);
                }

                $afterChecklist = $result['after_checklist'];
                $returnMessage = "Return Kendaraan untuk booking {$booking->booking_code} selesai.\n" .
                                 "Isi form checklist setelah perjalanan sebelum menyelesaikan booking.\n" .
                                 "Referensi Checklist Setelah: Bandingkan kondisi kendaraan dengan kondisi awal untuk identifikasi kerusakan.\n\n" .
                                 "- Kondisi Bodi: " . ($afterChecklist->body_condition ?? 'N/A') . "\n" .
                                 "- Kondisi Interior: " . ($afterChecklist->interior_condition ?? 'N/A') . "\n" .
                                 "- Level BBM: " . ($afterChecklist->fuel_level ?? 'N/A') . "\n" .
                                 "- Aksesori: " . ($afterChecklist->accessories ?? 'N/A') . "\n" .
                                 "- Catatan: " . ($afterChecklist->notes ?: 'Tidak ada') . "\n" .
                                 "Status: " . strtoupper($booking->status) . ".";

                Http::withHeaders(["Authorization" => "1nBBrr338eUrS7zdXTnV"])
                    ->asForm()
                    ->post('https://api.fonnte.com/send', [
                        'target' => $target,
                        'message' => $returnMessage,
                        'source' => '6287739904530',
                        'countryCode' => '62',
                        'typing' => 'false',
                        'schedule' => '0',
                    ]);
            }
        } catch (\Throwable $e) {
            logger()->warning('Fonnte return notification error: ' . $e->getMessage());
        }

        $redirectBookingId = $booking->id;

        if ($result['penalties']->isEmpty()) {
            return redirect()->route($redirectRoute, $redirectBookingId)
                ->with('success', $message . ' Booking ini dapat diselesaikan.');
        } else {
            return redirect()->route('admin.booking.penalties', $redirectBookingId)
                ->with('success', $message)
                ->with('penalties_count', $result['penalties']->count())
                ->with('penalties_total', $result['penalties']->sum('amount'));
        }
    }

    /**
     * Show penalty approval form
     * GET /admin/booking/{id}/penalties
     */
    public function showPenalties($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Get penalties for this booking
        $penalties = $booking->penalties()->orderBy('created_at', 'desc')->get();

        // Get summary
        $summary = $this->penaltyService->getPenaltySummary($booking);

        return view('admin.penalty.index', compact('booking', 'penalties', 'summary'));
    }

    /**
     * Approve/mark penalty as paid
     * POST /admin/penalty/{id}/approve
     */
    public function approvePenalty(ApprovePenaltyRequest $request, $penaltyId)
    {
        $penalty = Penalty::findOrFail($penaltyId);
        $booking = $penalty->booking;

        // Authorize
        $this->authorize('approve', $penalty);

        // Approve penalty via service
        $result = $this->penaltyService->approvePenalty(
            $penalty,
            $request->validated()
        );

        if (!$result['success']) {
            return redirect()->back()
                ->with('error', $result['message']);
        }

        // Kirim notifikasi WA denda sudah dibayar
        $target = $booking->contact ?? ($booking->user->phone ?? null);
        $penaltyMessage = "Denda booking " . $booking->booking_code . " telah dibayar.\n" .
            "Tipe denda: " . $penalty->type_label . "\n" .
            "Deskripsi: " . $penalty->description . "\n" .
            "Jumlah: " . $penalty->formatted_amount . "\n" .
            "Status: Sudah Dibayar.\n" .
            "Terima kasih atas konfirmasi pembayarannya.";

        $this->sendFonnteWhatsApp($target, $penaltyMessage);

        return redirect()->back()
            ->with('success', $result['message'])
            ->with('status_message', $result['status_message']);
    }

    /**
     * Show booking completion form
     * GET /admin/booking/{id}/complete
     */
    public function completeForm($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Get completion status
        $completionStatus = $this->completionService->getCompletionStatus($booking);

        // Get final report data
        $report = null;
        if ($this->completionService->canComplete($booking)) {
            $report = $this->completionService->generateFinalReport($booking);
        }

        return view('admin.booking.final', compact('booking', 'completionStatus', 'report'));
    }

    /**
     * Complete a booking
     * POST /admin/booking/{id}/complete
     */
    public function completeBooking(CompleteBookingRequest $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Check if can complete
        if (!$this->completionService->canComplete($booking)) {
            return redirect()->back()
                ->with('error', $this->completionService->getCompletionMessage($booking));
        }

        // Complete booking
        $result = $this->completionService->complete($booking);

        if (!$result['success']) {
            return redirect()->back()
                ->with('error', $result['message']);
        }

        return redirect()->route('admin.renter.show', $booking->id)
            ->with('success', $result['message'])
            ->with('report', $result['report']);
    }

    /**
     * Get penalties summary (for dashboard/modal)
     */
    public function getPenaltiesSummary(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        $summary = $this->penaltyService->getPenaltySummary($booking);

        return response()->json($summary);
    }

    /**
     * Get completion status (for AJAX/modal updates)
     */
    public function getCompletionStatus(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        $status = $this->completionService->getCompletionStatus($booking);

        return response()->json($status);
    }

    /**
     * Show before checklist form
     * GET /admin/booking/{id}/checklist-before
     */
    public function beforeChecklistForm($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Check if booking is in correct status
        if (!in_array($booking->status, ['confirmed'])) {
            return redirect()->route('admin.renter.workflow', $booking->id)
                ->with('error', 'Checklist sebelum hanya dapat dilakukan saat status booking dikonfirmasi.');
        }

        return view('admin.return.before-checklist', compact('booking'));
    }

    /**
     * Submit before checklist
     * POST /admin/booking/{id}/checklist-before
     */
    public function submitBeforeChecklist(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Validate
        $request->validate([
            'body_condition' => 'required|string|max:500',
            'interior_condition' => 'required|string|max:500',
            'fuel_level' => 'required|string|max:100',
            'accessories' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Create before checklist
        $booking->checklists()->create([
            'checklist_type' => 'before',
            'body_condition' => $request->input('body_condition'),
            'interior_condition' => $request->input('interior_condition'),
            'fuel_level' => $request->input('fuel_level'),
            'accessories' => $request->input('accessories'),
            'notes' => $request->input('notes'),
        ]);

        // Update status to running
        $booking->update(['status' => 'running']);

        // Send Fonnte WA notification (optional, best-effort)
        try {
            $target = $booking->contact ?? $booking->user->phone ?? null;
            if ($target) {
                $target = preg_replace('/[^0-9+]/', '', $target);
                if (str_starts_with($target, '0')) {
                    $target = '62' . substr($target, 1);
                } elseif (str_starts_with($target, '+')) {
                    $target = substr($target, 1);
                }

                Http::withHeaders([
                    'Authorization' => '1nBBrr338eUrS7zdXTnV',
                ])->asForm()->post('https://api.fonnte.com/send', [
                    'target' => $target,
                    'message' => "Checklist Kendaraan Sebelum Perjalanan untuk booking {$booking->booking_code} sudah selesai.\n" .
                                 "Referensi Checklist Sebelum: Bandingkan kondisi mobil dengan checklist sebelum perjalanan untuk mengidentifikasi kerusakan.\n\n" .
                                 "- Kondisi Bodi: " . $request->input('body_condition') . "\n" .
                                 "- Kondisi Interior: " . $request->input('interior_condition') . "\n" .
                                 "- Level BBM: " . $request->input('fuel_level') . "\n" .
                                 "- Aksesori: " . $request->input('accessories') . "\n" .
                                 "- Catatan: " . ($request->input('notes') ?: 'Tidak ada') . "\n" .
                                 "Status: RUNNING.",
                    'source' => '6287739904530',
                    'countryCode' => '62',
                    'typing' => 'false',
                    'schedule' => '0',
                ]);
            }
        } catch (\Throwable $e) {
            // log but do not block user flow
            logger()->warning('Fonnte checklist notification error: ' . $e->getMessage());
        }

        return redirect()->route('admin.renter.workflow', $booking->id)
            ->with('success', 'Checklist sebelum berhasil disimpan. Booking sekarang dalam status BERLANGSUNG.');
    }

    /**
     * Extract photos from request - group by category
     */
    private function extractPhotosFromRequest(Request $request): array
    {
        $photos = [];

        foreach (['damage', 'interior', 'fuel', 'tire', 'exterior', 'accessories', 'general'] as $category) {
            $key = "photos.{$category}";
            if ($request->hasFile($key)) {
                $files = $request->file($key);

                // Handle both single file and array of files
                if (is_array($files)) {
                    $photos[$category] = array_filter($files); // Filter out null values
                } else {
                    $photos[$category] = $files;
                }
            }
        }

        return $photos;
    }
}
