<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'name',
        'email',
        'google_email',
        'rating',
        'food_rating',
        'service_rating',
        'ambiance_rating',
        'value_rating',
        'review',
        'pros',
        'cons',
        'images',
        'visit_type',
        'visit_date',
        'is_verified',
        'verified_purchase',
        'status',
        'is_featured',
        'restaurant_reply',
        'replied_at',
    ];

    protected function casts(): array
    {
        return [
            'images' => 'array',
            'visit_date' => 'date',
            'is_verified' => 'boolean',
            'verified_purchase' => 'boolean',
            'is_featured' => 'boolean',
            'replied_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function votes()
    {
        return $this->hasMany(ReviewVote::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
