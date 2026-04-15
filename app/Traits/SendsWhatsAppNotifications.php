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

        $phone = $target;
        $phoneClean = preg_replace('/[^0-9+]/', '', $phone);

        if (str_starts_with($phoneClean, '0')) {
            $phoneClean = '62' . substr($phoneClean, 1);
        } elseif (str_starts_with($phoneClean, '+')) {
            $phoneClean = substr($phoneClean, 1);
        }

        if (empty($phoneClean)) {
            logger()->warning('Fonnte: Empty phone number after cleaning: ' . $phone);
            return;
        }

        try {
            $response = Http::withHeaders(['Authorization' => env('FONNTE_API_TOKEN')])
                ->asForm()
                ->post('https://api.fonnte.com/send', [
                    'target' => $phoneClean,
                    'message' => $message,
                    'source' => '6287739904530',
                    'countryCode' => '62',
                    'typing' => 'false',
                    'schedule' => '0',
                ]);

            if ($response->successful()) {
                logger()->info('Fonnte message sent to: ' . $phoneClean);
            } else {
                logger()->warning('Fonnte API error for ' . $phoneClean . ': ' . $response->status());
            }
        } catch (\Throwable $e) {
            logger()->warning('Fonnte error: ' . $e->getMessage());
        }
    }
}
