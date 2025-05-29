<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        $restaurant = $this->route('restaurant');
        $user = auth()->user();
        return $user->userRole->code === 'admin' || $restaurant->user_id === $user->id;
    }

    public function rules(): array
    {
        return [
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'icon' => 'nullable|string|max:255',
            'net_weight' => 'nullable|integer|min:0',
        ];
    }
}
