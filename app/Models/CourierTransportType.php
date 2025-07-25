<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class CourierTransportType extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = [
        'name',
    ];

    protected $fillable = [
        'name',
        'icon'
    ];

    public function courierTransports(): HasMany
    {
        return $this->hasMany(CourierTransport::class);
    }
}
