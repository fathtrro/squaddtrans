<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'booking_id',
        'rating',
        'comment',
        'image_path'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->hasManyThrough(
            User::class,
            Booking::class,
            'id',
            'id',
            'booking_id',
            'user_id'
        );
    }
}
