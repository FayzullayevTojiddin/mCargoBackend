<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'courier' => $this->courier->toResource(),
            'transport' => $this->courierTransport->toResource(),
            'to_user' => $this->user->toResource(),
            'delivery_from' => $this->fromLocation->toResource(LocationResource::class),
            'delivery_to' => $this->toLocation->toResource(LocationResource::class),
            'estimated_time_sec_min' => $this->estimated_time_sec_min,
            'estimated_time_sec_max' => $this->estimated_time_sec_max,
            'price' => $this->price,
            'status' => $this->status
        ];
    }
}
