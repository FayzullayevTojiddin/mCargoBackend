<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProductOptionItem extends Model
{
    protected $fillable = [
        'order_product_item_id',
        'product_option_item_id',
        'name',
        'price',
        'net_weight',
    ];

    public function productOptionItem(): BelongsTo
    {
        return $this->belongsTo(ProductOptionItem::class);
    }

    public function orderProductItem(): BelongsTo
    {
        return $this->belongsTo(OrderProductItem::class);
    }
}
