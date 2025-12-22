<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'file_name',
        'file_path',
        'file_type',
        'title',
        'description',
        'is_primary',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
        ];
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    public function scopePdf($query)
    {
        return $query->where('file_type', 'pdf');
    }

    public function scopeImage($query)
    {
        return $query->where('file_type', 'image');
    }
}
