<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'event_title',
        'slug',
        'description',
        'event_type',
        'banner_image',
        'event_date',
        'end_date',
        'is_recurring',
        'recurrence_pattern',
        'entry_fee',
        'requires_booking',
        'booking_contact',
        'max_attendees',
        'current_attendees',
        'is_active',
        'view_count',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
            'end_date' => 'datetime',
            'is_recurring' => 'boolean',
            'requires_booking' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now());
    }

    public function scopeByType($query, $type)
    {
        return $query->where('event_type', $type);
    }

    public function scopeAvailableSeats($query)
    {
        return $query->whereColumn('current_attendees', '<', 'max_attendees')
            ->orWhereNull('max_attendees');
    }
}
