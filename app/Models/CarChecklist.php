<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarChecklist extends Model
{
    protected $fillable = [
        'booking_id',
        'checklist_type',
        'body_condition',
        'interior_condition',
        'fuel_level',
        'accessories',
        'notes',
        'photo'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
