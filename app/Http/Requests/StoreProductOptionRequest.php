<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = auth()->user();
        $product = Product::findOrFail($this->route('product'));
        return $user->id === $product->restaurant->user_id || $user->userRole->code === 'admin';
    }

    public function rules(): array
    {
        return [
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ];
    }
}
