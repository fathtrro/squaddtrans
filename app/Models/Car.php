<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'name',
        'plate_number',
        'year',
        'category',
        'seats',
        'transmission',
        'fuel_type',
        'price_24h',
        'price_12h',
        'price_with_driver',
        'price_carter',
        'main_image',
        'status',
    ];

    protected $appends = ['main_image', 'formatted_price_24h', 'formatted_price_12h'];

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function carChecklists()
    {
        return $this->hasMany(CarChecklist::class);
    }

    public function reviews()
    {
        return $this->hasManyThrough(
            Review::class,
            Booking::class,
            'car_id',      // Foreign key on bookings table
            'booking_id',  // Foreign key on reviews table
            'id',          // Local key on cars table
            'id'           // Local key on bookings table
        );
    }

    // Helper method untuk format harga
    public function getFormattedPrice24hAttribute()
    {
        return 'Rp ' . number_format($this->price_24h, 0, ',', '.');
    }

    public function getFormattedPrice12hAttribute()
    {
        return 'Rp ' . number_format($this->price_12h, 0, ',', '.');
    }

    // Get first image or default
    public function getMainImageAttribute()
    {
        // Cek apakah ada relasi images
        if ($this->images && $this->images->count() > 0) {
            $imagePath = $this->images->first()->image_path;

            // Cek apakah path sudah lengkap dengan storage/
            if (strpos($imagePath, 'storage/') === 0) {
                return asset($imagePath);
            }

            return asset('storage/' . $imagePath);
        }

        // Fallback ke kolom image utama
        if ($this->image) {
            // Cek apakah sudah full URL
            if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                return $this->image;
            }

            // Cek apakah path sudah lengkap dengan storage/
            if (strpos($this->image, 'storage/') === 0) {
                return asset($this->image);
            }

            return asset('storage/' . $this->image);
        }

        // Default placeholder image
        return asset('images/default-car.jpg');
    }
}
