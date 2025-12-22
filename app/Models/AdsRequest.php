<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'package_id',
        'ad_type',
        'adtype',
        'package_name',
        'price',
        'days',
        'file_name',
        'file_path',
        'buzzintownmenu',
        'url',
        'customer_name',
        'customer_email',
        'customer_phone',
        'payment_method',
        'payment_status',
        'transaction_id',
        'payment_proof',
        'paid_at',
        'ad_status',
        'rejection_reason',
        'ad_date',
        'start_date',
        'end_date',
        'notes',
        'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'paid_at' => 'datetime',
            'ad_date' => 'datetime',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function package()
    {
        return $this->belongsTo(AdPackage::class, 'package_id');
    }

    public function scopePending($query)
    {
        return $query->where('ad_status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('ad_status', 'approved');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeActive($query)
    {
        return $query->where('ad_status', 'active');
    }
}
