<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = auth()->user();
        $product = Product::findOrFail($this->route('product'));
        $productOption = ProductOption::findOrFail($this->route()->parameter('product_option'));
        return $user->id === $product->restaurant->user_id || $user->userRole->code === 'admin' && $productOption->product->id === $product->id;
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
