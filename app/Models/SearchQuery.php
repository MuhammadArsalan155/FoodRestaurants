<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'search_term',
        'search_type',
        'filters_applied',
        'results_count',
        'result_clicked',
        'clicked_restaurant_id',
        'session_id',
        'ip_address',
    ];

    public $timestamps = false;

    protected $dates = ['created_at'];

    protected function casts(): array
    {
        return [
            'filters_applied' => 'array',
            'result_clicked' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clickedRestaurant()
    {
        return $this->belongsTo(Restaurant::class, 'clicked_restaurant_id');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('search_type', $type);
    }

    public function scopePopularSearches($query, $limit = 10)
    {
        return $query->selectRaw('search_term, COUNT(*) as count')
            ->groupBy('search_term')
            ->orderByDesc('count')
            ->limit($limit);
    }
}
