<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CourierService extends Services
{
    public function getNearestCouriers(float $latitude, float $longitude, int $limit = 10): array
    {
        return DB::table('couriers')
            ->select('*', DB::raw("(
                6371 * acos(
                    cos(radians($latitude)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians($longitude)) +
                    sin(radians($latitude)) *
                    sin(radians(latitude))
                )
            ) AS distance"))
            ->orderBy('distance')
            ->limit($limit)
            ->get()
            ->toArray();
    }
}
