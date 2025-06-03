<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourierResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'courier_details' => [
                'first_name' => $this->user->first_name,
                'last_name' => $this->user->last_name,
                'full_name' => $this->user->first_name . "" . $this->user->last_name,
                'image' => Image::findOrFail($this->user->image_id)->path,
            ],
            'location' => $this->location->toResource(),
        ];
    }
}
