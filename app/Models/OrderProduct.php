<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderProduct extends Model
{
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'payment_id',
        'delivery_id',
        'number',
        'total_price',
        'net_weight',
        'notes',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restauran::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(OrderProductItem::class);
    }
}
