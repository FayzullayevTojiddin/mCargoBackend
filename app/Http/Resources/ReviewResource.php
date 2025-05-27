<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->toResource(),
            'comment' => $this->comment,
            'score' => $this->score,
            'for' => $this->reviewable->toResource(),
        ];
    }
}
