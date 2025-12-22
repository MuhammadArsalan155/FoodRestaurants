<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'video_url',
        'video_type',
        'video_id',
        'thumbnail',
        'title',
        'description',
        'duration',
        'is_featured',
        'view_count',
        'sort_order',
        'uploaded_by',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
        ];
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
