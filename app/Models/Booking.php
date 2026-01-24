<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'driver_id',
        'service_type',
        'start_datetime',
        'end_datetime',
        'destination',
        'dp_amount',
        'total_price',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function guarantees()
    {
        return $this->hasMany(Guarantee::class);
    }

    public function checklists()
    {
        return $this->hasMany(CarChecklist::class);
    }

    public function penalties()
    {
        return $this->hasMany(Penalty::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
