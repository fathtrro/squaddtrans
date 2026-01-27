<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InboxController extends Controller
{
    /**
     * Display a listing of the inbox messages.
     */
    public function index()
    {
        $messages = ContactUs::latest()->paginate(15);
        $unreadCount = ContactUs::unread()->count();

        return view('admin.inbox.index', compact('messages', 'unreadCount'));
    }

    /**
     * Display the specified message.
     */
    public function show(ContactUs $inbox)
    {
        // Mark as read
        if (!$inbox->is_read) {
            $inbox->markAsRead();
        }

        return view('admin.inbox.show', compact('inbox'));
    }

    /**
     * Mark message as responded.
     */
    public function update(Request $request, ContactUs $inbox)
    {
        $inbox->markAsResponded();

        return redirect()->route('admin.inbox.index')
            ->with('success', 'Pesan telah ditandai sebagai direspon.');
    }

    /**
     * Delete the specified message.
     */
    public function destroy(ContactUs $inbox)
    {
        $inbox->delete();

        return redirect()->route('admin.inbox.index')
            ->with('success', 'Pesan telah dihapus.');
    }
}
