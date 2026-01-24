<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Car extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'plate_number',
        'year',
        'price_12h',
        'price_24h',
        'status'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
