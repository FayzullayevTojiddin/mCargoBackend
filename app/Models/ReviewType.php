<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class ReviewType extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    protected $fillable = ['name'];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
