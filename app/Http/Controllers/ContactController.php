<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show the contact form
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Store the contact message
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Simpan pesan ke database
        ContactUs::create($validated);

        // You can also:
        // 1. Send email notification to admin
        // 2. Send confirmation email to user
        // Mail::send(...) - implement when you have email configured

        return redirect()->route('contact')
            ->with('success', 'Pesan Anda berhasil dikirim! Kami akan merespon dalam waktu 1 jam.');
    }
}
