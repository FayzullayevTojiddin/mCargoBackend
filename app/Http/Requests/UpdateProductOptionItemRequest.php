<?php

namespace App\Http\Requests;

use App\Models\ProductOptionItem;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductOptionItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        $item = ProductOptionItem::findOrFail($this->route('item'));
        $user = auth()->user();

        $isOwner = $user->id === $item->productOption->product->restaurant->user_id;
        $isAdmin = $user->userRole->code === 'admin';

        return $isOwner || $isAdmin;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|array',
            'name.*' => 'required|string|max:255',
            'net_weight' => 'nullable|integer|min:0',
        ];
    }
}
