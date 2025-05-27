<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'comment' => ['nullable', 'string', 'max:1000'],
            'score' => ['required', 'integer', 'in:1,2,3,4,5'],
        ];
    }
}
