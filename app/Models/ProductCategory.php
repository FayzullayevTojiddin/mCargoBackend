<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class ProductCategory extends Model
{
    use HasTranslations, HasFactory;

    public array $translatable = ['name'];

    protected $fillable = [
        'name',
        'restaurant_id',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
