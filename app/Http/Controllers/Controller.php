<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Http;

abstract class Controller
{
    use AuthorizesRequests;

    /**
     * Send WhatsApp notification via Fonnte API (best effort, no throw)
     */
    protected function sendFonnteWhatsApp(?string $target, string $message): void
    {
        if (empty($target) || empty($message)) {
            return;
        }

        $target = preg_replace('/[^0-9+]/', '', $target);

        if (str_starts_with($target, '0')) {
            $target = '62' . substr($target, 1);
        } elseif (str_starts_with($target, '+')) {
            $target = substr($target, 1);
        }

        if (empty($target)) {
            return;
        }

        try {
            Http::withHeaders(['Authorization' => '1nBBrr338eUrS7zdXTnV'])
                ->asForm()
                ->post('https://api.fonnte.com/send', [
                    'target' => $target,
                    'message' => $message,
                    'source' => '6287739904530',
                    'countryCode' => '62',
                    'typing' => 'false',
                    'schedule' => '0',
                ]);
        } catch (\Throwable $e) {
            logger()->warning('Fonnte notification error: ' . $e->getMessage());
        }
    }
}
