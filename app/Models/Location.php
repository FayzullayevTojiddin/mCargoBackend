<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Builder;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'locationable_type',
        'locationable_id',
        'latitude',
        'longitude',
        'city',
        'state',
        'country',
        'postal_code',
    ];

    public function locationable(): MorphTo
    {
        return $this->morphTo();
    }

    public static function scopeNearby(Builder $query, float $lat, float $lng, float $radius = 10): Builder
    {
        return $query->select('locationable_id')
            ->where('locationable_type', Restaurant::class)
            ->selectRaw("(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [
                $lat, $lng, $lat
            ])
            ->having('distance', '<=', $radius)
            ->orderBy('distance');
    }
}
