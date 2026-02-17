<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarChecklist extends Model
{
    protected $fillable = [
        'booking_id',
        'checklist_type',
        'body_condition',
        'interior_condition',
        'fuel_level',
        'accessories',
        'notes',
        'photo'
    ];

    /**
     * Relationships
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get all photos for this checklist
     */
    public function photos()
    {
        return $this->hasMany(CarChecklistPhoto::class, 'car_checklist_id');
    }

    /**
     * Get checklist type label
     */
    public function getChecklistTypeLabelAttribute()
    {
        return $this->checklist_type === 'before' ? 'Sebelum Perjalanan' : 'Sesudah Perjalanan';
    }

    /**
     * Check if has photos
     */
    public function hasPhotos()
    {
        return $this->photos()->exists();
    }

    /**
     * Get photo count
     */
    public function getPhotoCountAttribute()
    {
        return $this->photos()->count();
    }

    /**
     * Get damages from comparison (for after checklist)
     * This will be used to identify damages compared to before checklist
     */
    public function getDamagesAttribute()
    {
        if ($this->checklist_type !== 'after') {
            return [];
        }

        $beforeChecklist = $this->booking->getBeforeChecklist();
        if (!$beforeChecklist) {
            return [];
        }

        $damages = [];

        // Compare body condition
        if ($beforeChecklist->body_condition !== $this->body_condition) {
            $damages[] = 'Kondisi bodi berbeda';
        }

        // Compare interior condition
        if ($beforeChecklist->interior_condition !== $this->interior_condition) {
            $damages[] = 'Kondisi interior berbeda';
        }

        // Compare fuel level
        if ($beforeChecklist->fuel_level !== $this->fuel_level) {
            $damages[] = 'Level bahan bakar berbeda';
        }

        // Compare accessories
        if ($beforeChecklist->accessories !== $this->accessories) {
            $damages[] = 'Aksesori/perlengkapan berbeda';
        }

        return $damages;
    }
}

