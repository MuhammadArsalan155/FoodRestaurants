<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInteraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'deal_id',
        'action_type',
        'source_page',
        'device_type',
        'session_id',
        'ip_address',
    ];

    public $timestamps = false;

    protected $dates = ['created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

    public function scopeByAction($query, $action)
    {
        return $query->where('action_type', $action);
    }

    public function scopeByDevice($query, $device)
    {
        return $query->where('device_type', $device);
    }

    // Track interaction
    public static function track($data)
    {
        return self::create($data);
    }
}
