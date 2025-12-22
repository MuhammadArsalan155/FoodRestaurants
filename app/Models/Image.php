<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'file_name',
        'file_path',
        'original_name',
        'file_size',
        'width',
        'height',
        'type',
        'title',
        'alt_text',
        'caption',
        'is_featured',
        'is_cover',
        'sort_order',
        'uploaded_by',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_cover' => 'boolean',
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
