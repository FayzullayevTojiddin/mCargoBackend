<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'restaurant_id',
        'product_category_id',
        'name',
        'review',
        'description',
        'price',
        'icon',
        'net_weight'
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restauran::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(ProductOption::class);
    }
}
