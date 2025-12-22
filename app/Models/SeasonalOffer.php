<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonalOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'offer_title',
        'season_type',
        'year',
        'description',
        'banner_image',
        'special_menu',
        'discount_text',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'special_menu' => 'array',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('end_date', '>=', now());
    }

    public function scopeBySeason($query, $season)
    {
        return $query->where('season_type', $season);
    }
}
