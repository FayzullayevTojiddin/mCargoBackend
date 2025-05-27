<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'payment_type' => $this->paymentType->toResource(),
            'user_card_id' => $this->userCard->toResource() ,
            'total_price' => $this->total_price,
            'status' => $this->status,
        ];
    }
}
