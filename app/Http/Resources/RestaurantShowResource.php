<?php

namespace App\Http\Resources;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image->path,
            'review' => [
                'reviews_count' => $this->reviews->count(),
                'reviews_average' => round($this->reviews->avg('score'), 1),
            ],
            'categories' => IndexCategoriesResource::collection($this->categories),
            'location' => [
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude
            ]
        ];
    }
}
