<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductOptionRequest;
use App\Http\Requests\UpdateProductOptionRequest;
use App\Http\Resources\ProductOptionResource;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductOptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Product $product): JsonResponse
    {
        return $this->response(
            data: ProductOptionResource::collection($product->options)->toArray(request())
        );
    }

    public function show($productId, $productOptionId): JsonResponse
    {
        $product = Product::findOrFail($productId);
        $productOption = ProductOption::findOrFail($productOptionId);
        if($productOption->product->id === $product->id) {
            return $this->response(
                data: $productOption->toResource()->toArray(request())
            );
        }

        return $this->error(
            message: 'Product option not found'
        );
    }

    public function store(StoreProductOptionRequest $request, $productId): JsonResponse
    {
        $product = Product::findOrFail($productId);
        $product->options()->create($request->validated());
        return $this->success(
            message: 'Product option has been created',
            data: ProductOptionResource::collection($product->options)->toArray(request())
        );
    }

    public function update(UpdateProductOptionRequest $request, $productId, $productOptionId): JsonResponse
    {
        $product = Product::findOrFail($productId);
        $productOption = ProductOption::find($productOptionId);
        if($productOption->product->id === $product->id) {
            $productOption->update($request->validated());
            return $this->success(
                message: 'Product option has been updated',
                data: ProductOptionResource::collection($product->options)->toArray(request())
            );
        }

        return $this->error(
            message: 'Product option not found'
        );
    }

    public function destroy($productId, $productOptionId): JsonResponse
    {
        $user = auth()->user();
        $product = Product::findOrFail($productId);
        $productOption = ProductOption::findOrFail($productOptionId);
        if($product->restaurant->user_id === $user->id || $user->userRole->code === 'admin') {
            $productOption->delete();
            return $this->success(
                message: 'Product option has been deleted',
                data: ProductOptionResource::collection($product->options)->toArray(request())
            );
        }

        return $this->error(
            message: 'Product option not found'
        );
    }
}
