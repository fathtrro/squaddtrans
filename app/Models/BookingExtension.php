<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingExtension extends Model
{
    protected $table = 'booking_extensions';

    protected $fillable = [
        'booking_id',
        'old_end_datetime',
        'new_end_datetime',
        'extra_price',
        'status',
    ];

    protected $casts = [
        'old_end_datetime' => 'datetime',
        'new_end_datetime' => 'datetime',
        'extra_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationships
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the status label
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'requested' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => $this->status,
        };
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'requested' => 'bg-orange-100 text-orange-700',
            'approved' => 'bg-green-100 text-green-700',
            'rejected' => 'bg-red-100 text-red-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }
}
