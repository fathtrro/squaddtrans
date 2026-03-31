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
        if (empty($message)) {
            return;
        }

        // Master nomor kedua yang selalui dikirimi WA
        $static = '081231640441';

        $numbers = collect([$target, $static])->filter();

        foreach ($numbers->unique() as $phone) {
            $phoneClean = preg_replace('/[^0-9+]/', '', $phone);

            if (str_starts_with($phoneClean, '0')) {
                $phoneClean = '62' . substr($phoneClean, 1);
            } elseif (str_starts_with($phoneClean, '+')) {
                $phoneClean = substr($phoneClean, 1);
            }

            if (empty($phoneClean)) {
                continue;
            }

            try {
                Http::withHeaders(['Authorization' => '1nBBrr338eUrS7zdXTnV'])
                    ->asForm()
                    ->post('https://api.fonnte.com/send', [
                        'target' => $phoneClean,
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
}
