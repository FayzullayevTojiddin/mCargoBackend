<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class UserRole extends Model
{
    use HasTranslations;

    public array $translatable = [
        'name'
    ];

    protected $fillable = [
        'name',
        'code'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
