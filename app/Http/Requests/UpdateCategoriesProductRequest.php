<?php

namespace App\Http\Requests;

use App\Models\ProductCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriesProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        $categoryId = $this->route('category');
        $category = ProductCategory::findOrFail($categoryId);
        $user = auth()->user();

        $isOwner = $user->id === $category->restaurant->user_id;
        $isAdmin = $user->userRole->code === 'admin';

        return $isOwner || $isAdmin;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
        ];
    }
}
