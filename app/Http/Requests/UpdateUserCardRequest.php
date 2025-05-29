<?php

namespace App\Http\Requests;

use App\Models\UserCard;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        $userCard = UserCard::find($this->route('user_card'));
        return $userCard->user_id == auth()->id();
    }

    public function rules(): array
    {
        return [
            'card_type_id' => ['required', 'exists:card_types,id'],
            'placeholder_name' => ['nullable', 'string', 'max:255'],
            'number' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('user_cards')
                    ->where(fn ($query) => $query->where('user_id', auth()->id()))
                    ->ignore($this->route('user_card')),
            ],
            'exp_date' => ['nullable', 'string', 'max:10'],
            'cvv' => ['nullable', 'string', 'max:10'],
        ];
    }
}
