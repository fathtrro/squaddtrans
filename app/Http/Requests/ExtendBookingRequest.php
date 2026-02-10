<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class ExtendBookingRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() != null;
    }

    public function rules()
    {
        $booking = $this->route('booking');

        return [
            'new_end_datetime' => [
                'required',
                'date',
                'after:' . $booking->end_datetime->format('Y-m-d H:i:s'),
                function ($attribute, $value, $fail) use ($booking) {
                    // Pastikan minimal 1 jam perpanjangan
                    $oldEnd = $booking->end_datetime;
                    $newEnd = Carbon::parse($value);
                    
                    if ($oldEnd->diffInHours($newEnd) < 1) {
                        $fail('Perpanjangan minimal 1 jam dari waktu selesai saat ini.');
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'new_end_datetime.required' => 'Waktu selesai baru harus diisi',
            'new_end_datetime.date' => 'Format waktu tidak valid',
            'new_end_datetime.after' => 'Waktu selesai baru harus setelah waktu selesai saat ini',
        ];
    }
}
