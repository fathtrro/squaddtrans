<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'payment_type',
        'amount',
        'payment_method',
        'bank_id',
        'proof_image',
        'status',
        'paid_at'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'bank_id');
    }
}
