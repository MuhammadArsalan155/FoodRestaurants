<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_name',
        'slug',
        'description',
        'ad_type',
        'duration_days',
        'price',
        'features',
        'position',
        'max_impressions',
        'is_active',
        'is_popular',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'is_active' => 'boolean',
            'is_popular' => 'boolean',
        ];
    }

    public function adsRequests()
    {
        return $this->hasMany(AdsRequest::class, 'package_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('ad_type', $type);
    }
}
