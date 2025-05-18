<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    public array $translatable = [
        'name',
        'description'
    ];

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
