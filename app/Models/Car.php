<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'plate_number',
        'image',
        'year',
        'price_12h',
        'price_24h',
        'status',
    ];

    protected $casts = [
        'price_12h' => 'decimal:2',
        'price_24h' => 'decimal:2',
        'year' => 'integer',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class);
    }
}
