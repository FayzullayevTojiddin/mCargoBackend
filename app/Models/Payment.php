<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'payment_type_id',
        'user_card_id',
        'delivery_price',
        'total_price',
        'status',
    ];

    public function userCard(): BelongsTo
    {
        return $this->belongsTo(UserCard::class);
    }

    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }
}
