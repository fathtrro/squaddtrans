<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    /**
     * Penalty type constants
     */
    const TYPE_LATE = 'late';
    const TYPE_DAMAGE = 'damage';
    const TYPE_OTHER = 'other';

    /**
     * Penalty status constants
     */
    const STATUS_UNPAID = 'unpaid';
    const STATUS_PAID = 'paid';

    protected $fillable = [
        'booking_id',
        'type',
        'description',
        'amount',
        'status'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
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
     * Get penalty type label
     */
    public function getTypeLabelAttribute()
    {
        $labels = [
            self::TYPE_LATE => 'Keterlambatan',
            self::TYPE_DAMAGE => 'Kerusakan',
            self::TYPE_OTHER => 'Lainnya',
        ];

        return $labels[$this->type] ?? $this->type;
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return $this->status === self::STATUS_UNPAID ? 'Belum Dibayar' : 'Sudah Dibayar';
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute()
    {
        return $this->status === self::STATUS_UNPAID
            ? 'bg-red-100 text-red-800'
            : 'bg-green-100 text-green-800';
    }

    /**
     * Get formatted amount
     */
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    /**
     * Scope for unpaid penalties
     */
    public function scopeUnpaid($query)
    {
        return $query->where('status', self::STATUS_UNPAID);
    }

    /**
     * Scope for paid penalties
     */
    public function scopePaid($query)
    {
        return $query->where('status', self::STATUS_PAID);
    }

    /**
     * Scope by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Mark as paid
     */
    public function markAsPaid()
    {
        return $this->update(['status' => self::STATUS_PAID]);
    }

    /**
     * Mark as unpaid
     */
    public function markAsUnpaid()
    {
        return $this->update(['status' => self::STATUS_UNPAID]);
    }

    /**
     * Check if unpaid
     */
    public function isUnpaid()
    {
        return $this->status === self::STATUS_UNPAID;
    }

    /**
     * Check if paid
     */
    public function isPaid()
    {
        return $this->status === self::STATUS_PAID;
    }
}

