<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ProductOptionItem extends Model
{
    use HasTranslations, HasFactory, SoftDeletes;

    public array $translatable = ['name'];

    protected $fillable = [
        'product_option_id',
        'name',
        'net_weight',
    ];

    public function productOption(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class);
    }
}
