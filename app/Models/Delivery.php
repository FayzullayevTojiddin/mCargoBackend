<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Delivery extends Model
{
    protected $fillable = [
        'delivery_type_id',
        'number',
        'delivery_at',
        'price',
        'status',
    ];

    public function deliveryType(): BelongsTo
    {
        return $this->belongsTo(DeliveryType::class);
    }
}
