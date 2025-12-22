<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'review_id',
        'user_id',
        'is_helpful',
    ];

    public $timestamps = false;

    protected $dates = ['created_at'];

    protected function casts(): array
    {
        return [
            'is_helpful' => 'boolean',
        ];
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeHelpful($query)
    {
        return $query->where('is_helpful', true);
    }

    public function scopeNotHelpful($query)
    {
        return $query->where('is_helpful', false);
    }
}
