<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductReviewRequest;
use App\Http\Requests\UpdateProductReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\JsonResponse;

class ProductReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index($productId): JsonResponse
    {
        $product = Product::findOrFail($productId);
        return $this->response(
            data: ReviewResource::collection($product->reviews)->toArray(request()),
        );
    }

    public function store(StoreProductReviewRequest $request, $productId): JsonResponse
    {
        $product = Product::findOrFail($productId);
        if (Review::where('user_id', auth()->id())
            ->where('reviewable_id', $productId)
            ->where('reviewable_type', Product::class)
            ->exists()) {
            return $this->error(
                message: "Review already exists for this product.",
            );
        }
        $user = auth()->user();
        $review = Review::create([
            'user_id' => $user->id,
            'reviewable_id' => $product->id,
            'reviewable_type' => Product::class,
            'score' => $request->score,
            'comment' => $request->comment,
        ]);

        return $this->success(
            message: 'Review created successfully',
            data: $review->toResource()->toArray(request())
        );
    }

    public function update(UpdateProductReviewRequest $request, $productId, $reviewId): JsonResponse
    {
      $review = Review::find($reviewId);
      $review->update([
          'user_id' => auth()->id(),
          'reviewable_id' => $productId,
          'reviewable_type' => Product::class,
          ...$request->validated(),
      ]);
      return $this->success(
          message: 'Review updated successfully',
          data: $review->toResource()->toArray(request())
      );
    }

    public function destroy($productId, $reviewId): JsonResponse
    {
        $review = Review::where('id', $reviewId)
            ->where('user_id', auth()->id())
            ->where('reviewable_id', $productId)
            ->where('reviewable_type', Product::class)
            ->first();

        if (!$review) {
            return $this->error(message: 'Review not found or unauthorized.');
        }

        $review->delete();

        return $this->success(
            message: 'Review deleted successfully.', data: $review->toResource()->toArray(request())
        );
    }
}
