<?php

namespace App\Services;

use App\Models\Courier;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CourierService extends Services
{
    public function getNearestCouriers(float $latitude, float $longitude, int $limit = 10): Collection
    {
        return Courier::with('user')
            ->selectRaw(
                "couriers.*, (
                    6371 * acos(
                        cos(radians(?)) *
                        cos(radians(latitude)) *
                        cos(radians(longitude) - radians(?)) +
                        sin(radians(?)) *
                        sin(radians(latitude))
                    )
                ) AS distance",
                [$latitude, $longitude, $latitude]
            )
            ->orderBy('distance')
            ->limit($limit)
            ->get();
    }
}
