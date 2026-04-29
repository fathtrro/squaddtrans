<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Show the form for creating a new review
     */
    public function create()
    {
        // Get user's completed bookings without reviews
        $bookings = Booking::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->doesntHave('reviews')
            ->with('car')
            ->get();

        return view('reviews.create', compact('bookings'));
    }

    /**
     * Store a newly created review in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // Verify the booking belongs to the authenticated user
        $booking = Booking::findOrFail($validated['booking_id']);

        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Check if booking is completed
        if ($booking->status !== 'completed') {
            return redirect()->back()
                ->with('error', 'Anda hanya dapat mengulas pemesanan yang sudah selesai.');
        }

        // Check if user already reviewed this booking
        if ($booking->reviews()->where('user_id', Auth::id())->exists()) {
            return redirect()->back()
                ->with('error', 'Anda sudah mengulas pemesanan ini.');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reviews', 'public');
        }

        Review::create([
            'booking_id' => $validated['booking_id'],
            'user_id' => Auth::id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
            'image_path' => $imagePath
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Ulasan Anda berhasil ditambahkan!');
    }
}

