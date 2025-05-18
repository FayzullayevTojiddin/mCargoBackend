<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderProductItem extends Model
{
    protected $fillable = [
        'order_product_id',
        'product_id',
        'total_price',
        'quantity',
        'net_weight',
        'product_snapshot'
    ];

    public function orderProduct(): BelongsTo
    {
        return $this->belongsTo(OrderProduct::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productOptions(): HasMany
    {
        return $this->hasMany(OrderProductOption::class);
    }
}
