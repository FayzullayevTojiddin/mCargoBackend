<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class CartItemOption extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    protected $fillable = [
        'product_option_id',
        'cart_item_id',
        'price',
        'name',
        'saved_at',
        'snapshot_product_option',
    ];

    public function cartItem(): BelongsTo
    {
        return $this->belongsTo(CartItem::class);
    }

    public function productOption(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class);
    }
}
