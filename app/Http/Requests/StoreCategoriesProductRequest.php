<?php

namespace App\Http\Requests;

use App\Models\Restaurant;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriesProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        $restaurantId = $this->route('restaurant');
        $restaurant = Restaurant::findOrFail($restaurantId);
        $user = auth()->user();

        $isOwner = $restaurant->user_id == $user->id;
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
