<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantBranch extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_restaurant_id',
        'branch_name',
        'location',
        'area',
        'city',
        'latitude',
        'longitude',
        'phone',
        'email',
        'manager_name',
        'opening_time',
        'closing_time',
        'operating_days',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'operating_days' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'parent_restaurant_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
