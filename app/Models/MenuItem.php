<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'menu_category_id',
        'item_name',
        'description',
        'image',
        'price',
        'discounted_price',
        'portion_size',
        'is_vegetarian',
        'is_spicy',
        'is_popular',
        'is_new',
        'is_available',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_vegetarian' => 'boolean',
            'is_spicy' => 'boolean',
            'is_popular' => 'boolean',
            'is_new' => 'boolean',
            'is_available' => 'boolean',
        ];
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function menuCategory()
    {
        return $this->belongsTo(MenuCategory::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
    }
}
