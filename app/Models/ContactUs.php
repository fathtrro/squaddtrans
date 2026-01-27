<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_read',
        'responded_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'responded_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope untuk pesan yang belum dibaca
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope untuk pesan berdasarkan subjek
     */
    public function scopeBySubject($query, $subject)
    {
        return $query->where('subject', $subject);
    }

    /**
     * Tandai pesan sebagai telah dibaca
     */
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    /**
     * Tandai pesan sebagai telah direspon
     */
    public function markAsResponded()
    {
        $this->update(['responded_at' => now()]);
    }
}
