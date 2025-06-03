<?php

namespace App\Models;

use App\Traits\HasLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Delivery extends Model
{
    use HasFactory, HasLocation;

    protected $fillable = [
        'courier_id',
        'courier_transport_id',
        'delivery_from_id',
        'delivery_to_id',
        'user_id',
        'number',
        'delivery_at',
        'price',
        'estimated_time_sec_min',
        'estimated_time_sec_max',
        'status',
    ];

    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function courierTransport(): BelongsTo
    {
        return $this->belongsTo(CourierTransport::class);
    }

    public function fromLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'delivery_from_id');
    }

    public function toLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'delivery_to_id');
    }
}
