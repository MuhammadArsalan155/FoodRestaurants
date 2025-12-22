<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'restaurant_name',
        'slug',
        'tagline',
        'description',
        'logo',
        'cover_image',
        'banner_image',
        'email',
        'phone',
        'whatsapp',
        'website',
        'contact',
        'cellno',
        'location',
        'area',
        'city',
        'address_line1',
        'address_line2',
        'postal_code',
        'latitude',
        'longitude',
        'google_maps_url',
        'embed_map',
        'established_year',
        'owner_name',
        'license_number',
        'dine_in',
        'takeaway',
        'home_delivery',
        'reservation_available',
        'catering_available',
        'breakfast',
        'lunch',
        'dinner',
        'hitea',
        'lunch_buffet',
        'dinner_buffet',
        'brunch_menu',
        'alacarte',
        'opening_time',
        'closing_time',
        'is_24_hours',
        'operating_days',
        'price_range',
        'average_cost_per_person',
        'parking_available',
        'wifi_available',
        'halal_certified',
        'status',
        'publish',
        'is_featured',
        'is_premium',
        'is_trending',
    ];

    protected function casts(): array
    {
        return [
            'operating_days' => 'array',
            'awards' => 'array',
            'specialties' => 'array',
            'payment_methods' => 'array',
            'verified_at' => 'datetime',
            'featured_until' => 'datetime',
            'premium_until' => 'datetime',
            'reopening_date' => 'date',
            'dine_in' => 'boolean',
            'takeaway' => 'boolean',
            'home_delivery' => 'boolean',
            'is_featured' => 'boolean',
            'is_premium' => 'boolean',
            'is_trending' => 'boolean',
            'publish' => 'boolean',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'restaurant_categories')
            ->withPivot('is_primary');
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'restaurant_food')
            ->withPivot('price', 'is_featured');
    }

    public function branches()
    {
        return $this->hasMany(RestaurantBranch::class, 'parent_restaurant_id');
    }

    public function menuCategories()
    {
        return $this->hasMany(MenuCategory::class);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function menuFiles()
    {
        return $this->hasMany(MenuFile::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    public function seasonalOffers()
    {
        return $this->hasMany(SeasonalOffer::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'user_favorites');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active')->where('publish', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeTrending($query)
    {
        return $query->where('is_trending', true);
    }

    public function scopeInArea($query, $area)
    {
        return $query->where('area', $area);
    }

    public function scopeInCity($query, $city)
    {
        return $query->where('city', $city);
    }

    public function scopeWithDelivery($query)
    {
        return $query->where('home_delivery', true);
    }

    // Accessors
    public function getAverageRatingAttribute()
    {
        return $this->rating_average;
    }
}
