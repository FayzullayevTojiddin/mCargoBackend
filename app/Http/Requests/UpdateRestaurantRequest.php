<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRestaurantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->userRole->code === 'admin';
    }

    public function rules(): array
    {
        $restaurantId = $this->route('restaurant') ? $this->route('restaurant')->id : null;
        return [
            'image_id' => ['required', 'exists:images,id'],
            'name' => ['required', 'array'],
            'name.*' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'array'],
            'description.*' => ['nullable', 'string'],
            'latitude' => [
                'required',
                'numeric',
                'between:-90,90',
                Rule::unique('restaurants')
                    ->ignore($restaurantId)
                    ->where(fn ($query) => $query
                        ->where('user_id', auth()->id())
                        ->where('longitude', $this->input('longitude'))
                    ),
            ],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'address' => ['nullable', 'string', 'max:255'],
        ];
    }
}
