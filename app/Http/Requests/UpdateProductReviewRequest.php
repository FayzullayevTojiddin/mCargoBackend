<?php

namespace App\Http\Requests;

use App\Models\Review;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        $reviewId = $this->route('review');
        $userId = auth()->id();
        return Review::where('id', $reviewId)
            ->where('user_id', $userId)
            ->exists();
    }

    public function rules(): array
    {
        return [
            'score' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ];
    }
}
