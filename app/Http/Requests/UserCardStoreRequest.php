<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCardStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'card_type_id'      => ['required', 'exists:card_types,id'],
            'mask_number'            => ['required', 'string', 'max:32', 'unique:user_cards,number,NULL,id,user_id,' . $this->user()->id],
            'exp_date'          => ['required', 'string', 'max:7'],
        ];
    }
}
