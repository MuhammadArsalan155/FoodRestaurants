<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'slug',
        'description',
        'icon',
        'image',
        'banner_image',
        'file',
        'color_code',
        'parent_id',
        'sort_order',
        'restaurant_count',
        'is_active',
        'is_featured',
        'show_on_homepage',
        'meta_title',
        'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'show_on_homepage' => 'boolean',
        ];
    }

    // Relationships
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_categories');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeParentOnly($query)
    {
        return $query->whereNull('parent_id');
    }
}
