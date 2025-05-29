<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        $product = Product::findOrFail($this->route()->parameter('product'));
        $user = auth()->user();
        $productOption = ProductOption::findOrFail($this->route()->parameter('option'));
        return ($user->id === $product->restaurant->user_id || $user->userRole->code === 'admin')
            && $productOption->product->id === $product->id;
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
