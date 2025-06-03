<?php

if (! function_exists('estimateTime')) {
    function estimateTime(float $lat1, float $lng1, float $lat2, float $lng2): array
    {
        $distance = haversineDistance($lat1, $lng1, $lat2, $lng2);
        $averageSpeed = 25;
        $exactSeconds = ($distance / $averageSpeed) * 3600;
        $bufferPercent = 0.20;
        $minSeconds = $exactSeconds * (1 - $bufferPercent);
        $maxSeconds = $exactSeconds * (1 + $bufferPercent);
        $minMinutes = (int) round($minSeconds / 60);
        $maxMinutes = (int) round($maxSeconds / 60);
        $timeInMinutes = ($distance / $averageSpeed) * 60;
        return [
            'seconds_exact' => (int) round($exactSeconds),
            'seconds_min'   => (int) round($minSeconds),
            'seconds_max'   => (int) round($maxSeconds),
            'minutes_min'   => $minMinutes,
            'minutes_max'   => $maxMinutes,
            'text'          => "{$minMinutes}–{$maxMinutes} minutes",
        ];
    }
}

if (! function_exists('haversineDistance')) {
    function haversineDistance(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
