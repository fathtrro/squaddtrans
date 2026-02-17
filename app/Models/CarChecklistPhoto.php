<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarChecklistPhoto extends Model
{
    protected $table = 'car_checklist_photos';

    protected $fillable = [
        'car_checklist_id',
        'photo_path',
        'category',
        'description',
    ];

    /**
     * Relationships
     */
    public function checklist()
    {
        return $this->belongsTo(CarChecklist::class, 'car_checklist_id');
    }

    /**
     * Get full photo URL
     */
    public function getPhotoUrlAttribute()
    {
        return asset('storage/' . $this->photo_path);
    }

    /**
     * Get photo category label
     */
    public function getCategoryLabelAttribute()
    {
        $labels = [
            'damage' => 'Kerusakan',
            'interior' => 'Interior',
            'fuel' => 'Bahan Bakar',
            'tire' => 'Ban',
            'exterior' => 'Eksterior',
            'accessories' => 'Aksesori',
            'general' => 'Umum',
        ];

        return $labels[$this->category] ?? $this->category;
    }
}
