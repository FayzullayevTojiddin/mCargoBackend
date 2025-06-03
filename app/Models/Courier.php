<?php

namespace App\Models;

use App\Traits\HasLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courier extends Model
{
    use HasFactory, SoftDeletes, HasLocation;

    protected $fillable = [
        'user_id',
        'balance'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function courierTransports(): HasMany
    {
        return $this->hasMany(CourierTransport::class);
    }
}
