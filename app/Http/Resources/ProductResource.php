<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->icon,
            'net_weight' => $this->net_weight,
            'review' => [
                'reviews_count' => $this->reviews->count(),
                'reviews_average' => round($this->reviews->avg('score'), 1),
            ],
            'price' => [
                'discount_price' => $this->price - 6,
                'original_price' => $this->price
            ],
            'options' => ProductOptionResource::collection($this->options)
        ];
    }
}
