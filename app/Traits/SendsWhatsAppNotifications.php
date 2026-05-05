<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait SendsWhatsAppNotifications
{
    /**
     * Send WhatsApp notification via Fonnte API
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
            logger()->warning('Fonnte: Invalid phone number: ' . $target);
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
                logger()->info('Fonnte sent: ' . $phoneClean . ' | ' . $response->body());
            } else {
                logger()->warning('Fonnte failed: ' . $phoneClean . ' | ' . $response->status() . ' | ' . $response->body());
            }

        } catch (\Throwable $e) {
            logger()->error('Fonnte exception: ' . $e->getMessage());
        }
    }
}
