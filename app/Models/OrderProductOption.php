<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class OrderProductOption extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    protected $fillable = [
        'order_product_item_id',
        'product_option_id',
        'price',
        'name',
        'product_option_snapshot'
    ];

    public function orderProductItem(): BelongsTo
    {
        return $this->belongsTo(OrderProductItem::class);
    }

    public function productOption(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class);
    }

    public function optionItems(): HasMany
    {
        return $this->hasMany(OrderProductOptionItem::class);
    }
}
