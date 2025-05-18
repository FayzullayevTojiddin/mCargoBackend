<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class CartItemOptionItem extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    protected $fillable = [
        'cart_item_option_id',
        'product_option_item_id',
        'name',
        'price',
        'saved_at',
        'snapshot_product_option_item'
    ];

    public function productOptionItem(): BelongsTo
    {
        return $this->belongsTo(ProductOptionItem::class);
    }

    public function cartItemOption(): BelongsTo
    {
        return $this->belongsTo(CartItemOption::class);
    }
}
