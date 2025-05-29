<?php

namespace App\Http\Requests;

use App\Models\ProductOption;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductOptionItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        $productOption = ProductOption::findOrFail($this->route('option'));
        $user = auth()->user();
        $isProductOwner = $user->id == $productOption->product->restaurant->user_id;
        $isAdmin = $user->userRole->code === 'admin';
        return $isProductOwner || $isAdmin;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'net_weight' => 'nullable|integer|min:0',
        ];
    }
}
