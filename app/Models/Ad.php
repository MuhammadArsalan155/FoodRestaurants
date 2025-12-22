<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'title',
        'file_name',
        'file_path',
        'ad_type',
        'adtype',
        'position',
        'url',
        'target_blank',
        'impressions',
        'clicks',
        'ctr',
        'start_date',
        'end_date',
        'daysfor',
        'is_active',
        'publish',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'target_blank' => 'boolean',
            'is_active' => 'boolean',
            'publish' => 'boolean',
        ];
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('publish', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    public function scopeByType($query, $type)
    {
        return $query->where('ad_type', $type);
    }

    public function scopeByPosition($query, $position)
    {
        return $query->where('position', $position);
    }

    // Increment impressions
    public function recordImpression()
    {
        $this->increment('impressions');
        $this->updateCtr();
    }

    // Increment clicks
    public function recordClick()
    {
        $this->increment('clicks');
        $this->updateCtr();
    }

    // Update CTR
    protected function updateCtr()
    {
        if ($this->impressions > 0) {
            $this->ctr = ($this->clicks / $this->impressions) * 100;
            $this->save();
        }
    }
}
