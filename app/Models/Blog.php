<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'blog_title',
        'title',
        'slug',
        'blog_description',
        'excerpt',
        'blog_content',
        'content',
        'featured_image',
        'created_by',
        'author_id',
        'category_id',
        'tags',
        'status',
        'published_at',
        'scheduled_at',
        'is_featured',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'published_at' => 'datetime',
            'scheduled_at' => 'datetime',
            'is_featured' => 'boolean',
        ];
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
