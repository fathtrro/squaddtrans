<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    /**
     * Cast attributes to native types
     */
    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
        'dp_amount' => 'decimal:2',
        'total_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationships
     */
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

    /**
     * Accessors - Format Price
     */
    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    public function getFormattedDpAmountAttribute()
    {
        return 'Rp ' . number_format($this->dp_amount, 0, ',', '.');
    }

    public function getFormattedRemainingPaymentAttribute()
    {
        $remaining = $this->total_price - $this->dp_amount;
        return 'Rp ' . number_format($remaining, 0, ',', '.');
    }

    /**
     * Accessors - Format DateTime
     */
    public function getFormattedStartDateAttribute()
    {
        return $this->start_datetime instanceof Carbon
            ? $this->start_datetime->format('d M Y')
            : Carbon::parse($this->start_datetime)->format('d M Y');
    }

    public function getFormattedStartTimeAttribute()
    {
        return $this->start_datetime instanceof Carbon
            ? $this->start_datetime->format('H:i')
            : Carbon::parse($this->start_datetime)->format('H:i');
    }

    public function getFormattedEndDateAttribute()
    {
        return $this->end_datetime instanceof Carbon
            ? $this->end_datetime->format('d M Y')
            : Carbon::parse($this->end_datetime)->format('d M Y');
    }

    public function getFormattedEndTimeAttribute()
    {
        return $this->end_datetime instanceof Carbon
            ? $this->end_datetime->format('H:i')
            : Carbon::parse($this->end_datetime)->format('H:i');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at instanceof Carbon
            ? $this->created_at->format('d M Y, H:i')
            : Carbon::parse($this->created_at)->format('d M Y, H:i');
    }

    /**
     * Calculate duration in days
     */
    public function getDurationInDaysAttribute()
    {
        $start = $this->start_datetime instanceof Carbon
            ? $this->start_datetime
            : Carbon::parse($this->start_datetime);

        $end = $this->end_datetime instanceof Carbon
            ? $this->end_datetime
            : Carbon::parse($this->end_datetime);

        return $start->diffInDays($end) ?: 1;
    }

    /**
     * Get status badge class for UI
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
            'confirmed' => 'bg-blue-100 text-blue-800 border-blue-300',
            'running' => 'bg-green-100 text-green-800 border-green-300',
            'completed' => 'bg-gray-100 text-gray-800 border-gray-300',
            'cancelled' => 'bg-red-100 text-red-800 border-red-300',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
    }

    /**
     * Get human-readable status label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'running' => 'Sedang Berjalan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        return $labels[$this->status] ?? 'Unknown';
    }

    /**
     * Get service type label
     */
    public function getServiceTypeLabelAttribute()
    {
        $labels = [
            'lepas_kunci' => 'Lepas Kunci',
            'dengan_sopir' => 'Dengan Sopir',
            'carter' => 'Carter',
        ];

        return $labels[$this->service_type] ?? ucwords(str_replace('_', ' ', $this->service_type));
    }

    /**
     * Scopes
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeRunning($query)
    {
        return $query->where('status', 'running');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'confirmed', 'running']);
    }

    /**
     * Check if booking can be cancelled
     */
    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'confirmed']);
    }

    /**
     * Check if booking is active
     */
    public function isActive()
    {
        return in_array($this->status, ['pending', 'confirmed', 'running']);
    }

    /**
     * Check if booking is completed
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    /**
     * Check if booking needs driver
     */
    public function needsDriver()
    {
        return in_array($this->service_type, ['dengan_sopir', 'carter']);
    }

    /**
     * Get total paid amount from payments
     */
    public function getTotalPaidAttribute()
    {
        return $this->payments()->where('status', 'completed')->sum('amount');
    }

    /**
     * Get remaining payment amount
     */
    public function getRemainingPaymentAttribute()
    {
        return $this->total_price - $this->total_paid;
    }

    /**
     * Check if DP is paid
     */
    public function isDpPaid()
    {
        return $this->total_paid >= $this->dp_amount;
    }

    /**
     * Check if fully paid
     */
    public function isFullyPaid()
    {
        return $this->total_paid >= $this->total_price;
    }

    /**
     * Get booking number with padding
     */
    public function getBookingNumberAttribute()
    {
        return 'BK-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Get days until start
     */
    public function getDaysUntilStartAttribute()
    {
        $start = $this->start_datetime instanceof Carbon
            ? $this->start_datetime
            : Carbon::parse($this->start_datetime);

        return now()->diffInDays($start, false);
    }

    /**
     * Check if booking is upcoming
     */
    public function isUpcoming()
    {
        return $this->start_datetime > now();
    }

    /**
     * Check if booking is overdue (past end datetime)
     */
    public function isOverdue()
    {
        return $this->end_datetime < now() && !in_array($this->status, ['completed', 'cancelled']);
    }
}
