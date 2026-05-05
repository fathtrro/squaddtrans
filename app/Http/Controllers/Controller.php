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
        if (empty($message) || empty($target)) {
            return;
        }

        $phoneClean = preg_replace('/[^0-9+]/', '', $target);

        if (str_starts_with($phoneClean, '0')) {
            $phoneClean = '62' . substr($phoneClean, 1);
        } elseif (str_starts_with($phoneClean, '+')) {
            $phoneClean = substr($phoneClean, 1);
        }

        if (empty($phoneClean)) {
            logger()->warning('Fonnte: Empty phone number after cleaning: ' . $target);
            return;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => config('services.fonnte.token')
            ])
            ->withOptions([
                'verify' => false
            ])
            ->timeout(30)
            ->asForm()
            ->post('https://api.fonnte.com/send', [
                'target' => $phoneClean,
                'message' => $message,
            ]);

            if ($response->successful()) {
                logger()->info('Fonnte success: ' . $phoneClean . ' | ' . $response->body());
            } else {
                logger()->warning('Fonnte API error: ' . $phoneClean . ' | ' . $response->status() . ' | ' . $response->body());
            }

        } catch (\Throwable $e) {
            logger()->error('Fonnte exception: ' . $phoneClean . ' | ' . $e->getMessage());
        }
    }
}
