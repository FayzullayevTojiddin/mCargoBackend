<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductReviewRequest;
use App\Http\Requests\StoreRestaurantReviewRequest;
use App\Http\Requests\UpdateRestaurantReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\ReviewShowResource;
use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestaurantReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index($restaurantId): JsonResponse
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        return $this->response(
            data: ReviewResource::collection($restaurant->reviews)->toArray(request()),
        );
    }

    public function store(StoreRestaurantReviewRequest $request, $restaurantId): JsonResponse
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        if (Review::where('user_id', auth()->id())
            ->where('reviewable_id', $restaurantId)
            ->where('reviewable_type', Restaurant::class)
            ->exists()) {
            return $this->error(
                message: "Review already exists for this restaurant.",
            );
        }
        $user = auth()->user();
        $review = Review::create([
            'user_id' => $user->id,
            'reviewable_id' => $restaurant->id,
            'reviewable_type' => Restaurant::class,
            'score' => $request->score,
            'comment' => $request->comment,
        ]);

        return $this->success(
            message: 'Review created successfully',
            data: $review->toResource()->toArray(request())
        );
    }

    public function destroy($restaurantId, $reviewId): JsonResponse
    {
        $review = Review::where('id', $reviewId)
            ->where('user_id', auth()->id())
            ->where('reviewable_id', $restaurantId)
            ->where('reviewable_type', Restaurant::class)
            ->first();

        if (!$review) {
            return $this->error(message: 'Review not found or unauthorized.');
        }

        $review->delete();

        return $this->success(
            message: 'Review deleted successfully.', data: $review->toResource()->toArray(request())
        );
    }

    public function update(UpdateRestaurantReviewRequest $request, $restaurantId, $reviewId): JsonResponse
    {
        $review = Review::find($reviewId);
        $review->update([
            'user_id' => auth()->id(),
            'reviewable_id' => $restaurantId,
            'reviewable_type' => Restaurant::class,
            ...$request->validated(),
        ]);
        return $this->success(
            message: 'Review updated successfully',
            data: $review->toResource()->toArray(request())
        );
    }
}
