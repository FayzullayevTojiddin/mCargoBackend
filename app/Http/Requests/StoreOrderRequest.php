<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'products' => ['required', 'array'],
            'products.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
            'products.*.options' => ['nullable', 'array'],
            'products.*.options.*.id' => ['required', 'integer', 'exists:product_options,id'],
            'products.*.options.*.item_id' => ['required', 'integer', 'exists:product_option_items,id'],
        ];
    }
}
