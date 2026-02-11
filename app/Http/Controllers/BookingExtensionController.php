<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExtendBookingRequest;
use App\Models\Booking;
use App\Models\BookingExtension;
use App\Services\ExtendBookingService;
use Illuminate\Http\Request;

class BookingExtensionController extends Controller
{
    private ExtendBookingService $extendService;

    public function __construct(ExtendBookingService $extendService)
    {
        $this->extendService = $extendService;
    }

    /**
     * Admin: List all extension requests
     */
    public function index()
    {
        $pendingExtensions = BookingExtension::with('booking.user', 'booking.car')
            ->where('status', 'requested')
            ->orderBy('created_at', 'desc')
            ->get();

        $approvedExtensions = BookingExtension::with('booking.user', 'booking.car')
            ->where('status', 'approved')
            ->orderBy('updated_at', 'desc')
            ->get();

        $rejectedExtensions = BookingExtension::with('booking.user', 'booking.car')
            ->where('status', 'rejected')
            ->orderBy('updated_at', 'desc')
            ->get();

        $pendingCount = $pendingExtensions->count();
        $approvedCount = $approvedExtensions->count();
        $rejectedCount = $rejectedExtensions->count();

        return view('admin.booking_extensions.index', compact(
            'pendingExtensions',
            'approvedExtensions',
            'rejectedExtensions',
            'pendingCount',
            'approvedCount',
            'rejectedCount'
        ));
    }

    /**
     * User: Request booking extension
     */
    public function store(ExtendBookingRequest $request, Booking $booking)
    {
        // Authorize: user can only extend their own bookings
        if ($booking->user_id !== auth()->id()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $newEnd = \Carbon\Carbon::parse($request->input('new_end_datetime'));
        $result = $this->extendService->requestExtension($booking, $newEnd);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => $result['success'],
                'message' => $result['message'],
                'extension' => $result['extension'] ?? null
            ], $result['success'] ? 200 : 400);
        }

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        }

        return redirect()->back()->with('error', $result['message']);
    }

    /**
     * Admin: Approve extension request
     */
    public function approve(Request $request, BookingExtension $extension)
    {
        $result = $this->extendService->approveExtension($extension);

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        }

        return redirect()->back()->with('error', $result['message']);
    }

    /**
     * Admin: Reject extension request
     */
    public function reject(Request $request, BookingExtension $extension)
    {
        $result = $this->extendService->rejectExtension($extension);

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        }

        return redirect()->back()->with('error', $result['message']);
    }

    /**
     * API: Check for conflicts before requesting extension
     * Used for frontend validation/feedback
     */
    public function checkConflict(Request $request, Booking $booking)
    {
        $request->validate([
            'new_end_datetime' => 'required|date',
        ]);

        $conflictService = app(\App\Services\BookingConflictService::class);
        $check = $conflictService->checkExtensionConflict(
            $booking,
            $request->input('new_end_datetime')
        );

        return response()->json([
            'has_conflict' => $check['has_conflict'],
            'conflicts' => $check['conflicts'],
            'message' => $check['has_conflict']
                ? 'Mobil tidak tersedia di waktu yang Anda pilih'
                : 'Mobil tersedia',
        ]);
    }
}
