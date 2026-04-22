<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class DebugPasswordResetController
{
    /**
     * Show password reset debug page (Development only)
     */
    public function index()
    {
        // Only allow in development
        if (!config('app.debug')) {
            abort(404);
        }

        // Get all recent reset tokens
        $resetTokens = DB::table('password_reset_tokens')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $resetLinks = [];
        foreach ($resetTokens as $token) {
            $resetLinks[] = [
                'email' => $token->email,
                'token' => $token->token,
                'created_at' => $token->created_at,
                'link' => URL::route('password.reset', ['token' => $token->token]),
            ];
        }

        return view('auth.debug-password-reset', [
            'resetLinks' => $resetLinks,
            'users' => User::select('id', 'email', 'name')->get(),
        ]);
    }

    /**
     * Get reset link for specific email
     */
    public function getLink(Request $request)
    {
        if (!config('app.debug')) {
            abort(404);
        }

        $email = $request->input('email');

        if (!$email) {
            return response()->json(['error' => 'Email required'], 400);
        }

        $resetToken = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$resetToken) {
            return response()->json(['error' => 'Reset token not found for this email'], 404);
        }

        $resetLink = URL::route('password.reset', ['token' => $resetToken->token]);

        return response()->json([
            'email' => $email,
            'token' => $resetToken->token,
            'link' => $resetLink,
            'created_at' => $resetToken->created_at,
        ]);
    }
}
