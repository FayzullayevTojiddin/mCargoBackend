<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'card_type' => [
                'id' => $this->card_type->id,
                'name' => $this->card_type->name,
                'icon' => $this->card_type->icon,
            ],
            'placeholder_name' => $this->placeholder_name,
            'number' => $this->number,
            'exp_date' => $this->exp_date,
        ];
    }
}
