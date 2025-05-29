<?php

namespace App\Http\Requests;

use App\Models\UserCard;
use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        $userCardId = $this->input('user_card_id');

        return $userCardId && UserCard::where('id', $userCardId)
                ->where('user_id', auth()->id())
                ->exists();
    }

    public function rules(): array
    {
        return [
            'payment_type_id' => ['required', 'exists:payment_types,id'],
            'user_card_id' => ['required', 'exists:user_cards,id'],
            'total_price' => ['required', 'numeric', 'min:0.01'],
        ];
    }
}
