<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'profile_image',
        'user_type',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Restaurant::class, 'user_favorites')
            ->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'role_user');
    // }

    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class, 'permission_user');
    // }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeRestaurantOwners($query)
    {
        return $query->where('user_type', 'restaurant_owner');
    }
}
