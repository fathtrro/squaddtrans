<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guarantee extends Model
{
    protected $fillable = [
        'booking_id',
        'type',
        'document_file',
        'status'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
