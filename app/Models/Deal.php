<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'deal_title',
        'slug',
        'description',
        'image',
        'terms_conditions',
        'original_price',
        'deal_price',
        'discount_percentage',
        'savings_amount',
        'deal_type',
        'serves',
        'includes',
        'valid_from',
        'valid_until',
        'available_days',
        'available_time_from',
        'available_time_until',
        'is_active',
        'is_featured',
        'is_exclusive',
        'badge_text',
    ];

    protected function casts(): array
    {
        return [
            'includes' => 'array',
            'available_days' => 'array',
            'valid_from' => 'datetime',
            'valid_until' => 'datetime',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'is_exclusive' => 'boolean',
        ];
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('valid_until', '>=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('deal_type', $type);
    }
}
