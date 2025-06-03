<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $userLocation = $request->user()->location;
        $restaurantLocation = $this->location;
        $estimateTime = estimateTime($userLocation->latitude, $restaurantLocation->longitude, $restaurantLocation->latitude, $restaurantLocation->longitude);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'review' => [
                'reviews_count' => $this->reviews->count(),
                'reviews_average' => round($this->reviews->avg('score'), 1),
            ],
            'image' => Image::find($this->image_id)->path,
            'location' => new LocationResource($this->location),
            'estimate_time' => $estimateTime,
        ];
    }
}
