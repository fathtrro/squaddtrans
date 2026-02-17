<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'booking_extension_id',
        'payment_type',
        'amount',
        'payment_method',
        'bank_id',
        'proof_image',
        'status',
        'paid_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Payment type constants
     */
    const TYPE_DP = 'dp';
    const TYPE_FINAL = 'pelunasan';
    const TYPE_PENALTY = 'denda';
    const TYPE_EXTENSION = 'perpanjangan';

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * Relationships
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'bank_id');
    }

    /**
     * Get extension if this is extension payment
     */
    public function extension()
    {
        return $this->belongsTo(BookingExtension::class, 'booking_extension_id');
    }

    /**
     * Get payment type label
     */
    public function getPaymentTypeLabelAttribute()
    {
        $labels = [
            self::TYPE_DP => 'Down Payment',
            self::TYPE_FINAL => 'Pelunasan',
            self::TYPE_PENALTY => 'Denda',
            self::TYPE_EXTENSION => 'Perpanjangan',
        ];

        return $labels[$this->payment_type] ?? $this->payment_type;
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            self::STATUS_PENDING => 'Menunggu Persetujuan',
            self::STATUS_APPROVED => 'Disetujui',
            self::STATUS_REJECTED => 'Ditolak',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            self::STATUS_PENDING => 'bg-yellow-100 text-yellow-800',
            self::STATUS_APPROVED => 'bg-green-100 text-green-800',
            self::STATUS_REJECTED => 'bg-red-100 text-red-800',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Get formatted amount
     */
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    /**
     * Scope for pending payments
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope for approved payments
     */
    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    /**
     * Scope for rejected payments
     */
    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    /**
     * Scope by payment type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('payment_type', $type);
    }

    /**
     * Mark as approved and set paid_at
     */
    public function approve()
    {
        return $this->update([
            'status' => self::STATUS_APPROVED,
            'paid_at' => now(),
        ]);
    }

    /**
     * Mark as rejected
     */
    public function reject()
    {
        return $this->update([
            'status' => self::STATUS_REJECTED,
        ]);
    }

    /**
     * Check if approved
     */
    public function isApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    /**
     * Check if pending
     */
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }
}

