<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\IndexProductResource;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Restaurant $restaurant): JsonResponse
    {
        return $this->response(IndexProductResource::collection($restaurant->products)->toArray(request()));
    }

    public function show(Restaurant $restaurant, Product $product): JsonResponse
    {
        return $this->response($product->toResource()->toArray(request()));
    }

    public function update(UpdateProductRequest $request, Restaurant $restaurant, Product $product): JsonResponse
    {
        $product->update($request->validated());
        return $this->success(
            message: "Product updated successfully.",
            data: $product->toResource()->toArray(request())
        );
    }

    public function destroy(Restaurant $restaurant, Product $product): JsonResponse
    {
        $user = auth()->user();
        if($restaurant->user_id === $user->id or $user->userRole->code === 'admin' and $product->delete()) {
            return $this->success(
                message: "Product deleted successfully.",
                data: $product->toResource()->toArray(request())
            );
        }

        return $this->error(
            message: "Unable to delete product.",
        );
    }

    public function store(StoreProductRequest $request, Restaurant $restaurant): JsonResponse
    {
        $product = $restaurant->products()->create($request->validated());
        return $this->success(
            message: "Product created successfully.",
            data: $product->toResource()->toArray(request())
        );
    }
}
