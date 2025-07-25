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
            'card_type' => $this->card_type->toResource(),
            'masked_number' => $this->masked_number,
            'exp_date' => $this->exp_date,
            'verified' => $this->verified
        ];
    }
}
