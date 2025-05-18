<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductOptionItem extends Model
{
    protected $fillable = [
        'product_option_id',
        'name',
    ];

    public function productOption(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class);
    }
}
