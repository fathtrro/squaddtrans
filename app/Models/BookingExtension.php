<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingExtension extends Model
{
    protected $table = 'booking_extensions';

    /**
     * Status constants
     */
    const STATUS_REQUESTED = 'requested';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

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
     * Get payment for this extension
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_extension_id');
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

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->extra_price, 0, ',', '.');
    }

    /**
     * Get extension duration in days
     */
    public function getDurationInDaysAttribute()
    {
        return $this->new_end_datetime->diffInDays($this->old_end_datetime);
    }

    /**
     * Scope for pending requests
     */
    public function scopeRequested($query)
    {
        return $query->where('status', self::STATUS_REQUESTED);
    }

    /**
     * Scope for approved extensions
     */
    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    /**
     * Scope for rejected extensions
     */
    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    /**
     * Approve extension
     */
    public function approve()
    {
        return $this->update(['status' => self::STATUS_APPROVED]);
    }

    /**
     * Reject extension
     */
    public function reject()
    {
        return $this->update(['status' => self::STATUS_REJECTED]);
    }

    /**
     * Check if requested
     */
    public function isRequested()
    {
        return $this->status === self::STATUS_REQUESTED;
    }

    /**
     * Check if approved
     */
    public function isApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    /**
     * Check if rejected
     */
    public function isRejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    /**
     * Check if payment is made for this extension
     */
    public function isPaymentMade()
    {
        return $this->payment && $this->payment->isApproved();
    }
}
