<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'reviews_count' => $this->reviews_count ?? 0,
            'reviews_avg_rating' => round($this->reviews_avg_rating ?? 0, 1),
        ];
    }
}
