<?php

namespace App\Models;

use App\Traits\HasLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasLocation;

    protected $fillable = [
        'image_id',
        'first_name',
        'last_name',
        'user_role_id',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userRole(): BelongsTo
    {
        return $this->belongsTo(UserRole::class);
    }

    public function orders(): HasMany
    {
        return $this->HasMany(OrderProduct::class);
    }

    public function cards(): HasMany
    {
        return $this->HasMany(UserCard::class);
    }

    public function payments(): HasMany
    {
        return $this->HasMany(Payment::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    public function cart(): HasOne
    {
        return $this->HasOne(Cart::class);
    }

    public function courier(): HasOne
    {
        return $this->HasOne(Courier::class);
    }

    public function orderProducts(): HasMany
    {
        return $this->HasMany(OrderProduct::class);
    }

    public function deliveries(): HasMany
    {
        return $this->HasMany(Delivery::class);
    }
}
