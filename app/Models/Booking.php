<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    /**
     * Status constants
     */
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_RUNNING = 'running';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_WAITING_PENALTY = 'waiting_penalty';
    const STATUS_WAITING_PAYMENT = 'waiting_payment';

    protected $fillable = [
        'booking_code',
        'user_id',
        'car_id',
        'driver_id',
        'service_type',
        'start_datetime',
        'end_datetime',
        'destination',
        'contact',
        'alamat',
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
    protected static function booted()
    {
        static::created(function ($booking) {
            if (!$booking->booking_code) {
                $booking->update([
                    'booking_code' => 'BK-' . now()->format('Ymd') . '-' . str_pad($booking->id, 4, '0', STR_PAD_LEFT)
                ]);
            }
        });
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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function extensions()
    {
        return $this->hasMany(BookingExtension::class);
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
        if (!$this->start_datetime || !$this->end_datetime) {
            return 1;
        }

        $start = $this->start_datetime instanceof Carbon
            ? $this->start_datetime
            : Carbon::parse($this->start_datetime);

        $end = $this->end_datetime instanceof Carbon
            ? $this->end_datetime
            : Carbon::parse($this->end_datetime);

        $days = $start->diffInDays($end);

        // If duration is 0 or negative, return 1 day minimum
        return $days > 0 ? $days : 1;
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
            'waiting_penalty' => 'bg-orange-100 text-orange-800 border-orange-300',
            'waiting_payment' => 'bg-purple-100 text-purple-800 border-purple-300',
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
            'waiting_penalty' => 'Menunggu Denda',
            'waiting_payment' => 'Menunggu Pembayaran',
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

    public function scopeWaitingPenalty($query)
    {
        return $query->where('status', 'waiting_penalty');
    }

    public function scopeWaitingPayment($query)
    {
        return $query->where('status', 'waiting_payment');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'confirmed', 'running']);
    }

    public function scopeAwaitingCompletion($query)
    {
        return $query->whereIn('status', ['waiting_penalty', 'waiting_payment', 'running']);
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

    /**
     * Check if before checklist exists
     */
    public function hasBeforeChecklist()
    {
        return $this->checklists()->where('checklist_type', 'before')->exists();
    }

    /**
     * Check if after checklist exists
     */
    public function hasAfterChecklist()
    {
        return $this->checklists()->where('checklist_type', 'after')->exists();
    }

    /**
     * Get before checklist
     */
    public function getBeforeChecklist()
    {
        return $this->checklists()->where('checklist_type', 'before')->first();
    }

    /**
     * Get after checklist
     */
    public function getAfterChecklist()
    {
        return $this->checklists()->where('checklist_type', 'after')->first();
    }

    /**
     * Check if has unpaid penalties
     */
    public function hasUnpaidPenalties()
    {
        return $this->penalties()->where('status', 'unpaid')->exists();
    }

    /**
     * Get total unpaid penalties
     */
    public function getTotalUnpaidPenalties()
    {
        return $this->penalties()->where('status', 'unpaid')->sum('amount');
    }

    /**
     * Get total paid penalties
     */
    public function getTotalPaidPenalties()
    {
        return $this->penalties()->where('status', 'paid')->sum('amount');
    }

    /**
     * Check can be returned (status running)
     */
    public function canBeReturned()
    {
        return $this->status === self::STATUS_RUNNING;
    }

    /**
     * Check can complete booking
     */
    public function canBeCompleted()
    {
        // Must have after checklist and no unpaid penalties
        return $this->hasAfterChecklist() && !$this->hasUnpaidPenalties();
    }

    /**
     * Get total with penalties
     */
    public function getTotalWithPenalties()
    {
        return $this->total_price + $this->getTotalUnpaidPenalties();
    }

    /**
     * Check if booking has extensions
     */
    public function hasExtensions()
    {
        return $this->extensions()->exists();
    }

    /**
     * Get total extensions amount
     */
    public function getExtensionsTotal()
    {
        return $this->extensions()->sum('price');
    }

    /**
     * Accessor for extensions total
     */
    public function getExtensionsTotalAttribute()
    {
        return $this->getExtensionsTotal();
    }
}
