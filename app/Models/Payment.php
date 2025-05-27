<?php

namespace App\Models;

use App\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_type_id',
        'user_card_id',
        'delivery_price',
        'total_price',
        'status',
    ];

    protected $casts = [
        'payment_status' => PaymentStatus::class,
    ];

    public function userCard(): BelongsTo
    {
        return $this->belongsTo(UserCard::class);
    }

    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
