<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Menampilkan halaman hubungi kami
    public function index()
    {
        return view('contact.index');
    }

    // Menangani submit form
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // 👉 Di sini nanti bisa:
        // - simpan ke database
        // - kirim email
        // - kirim ke WhatsApp API, dll

        return back()->with('success', 'Pesan Anda berhasil dikirim.');
    }
}
