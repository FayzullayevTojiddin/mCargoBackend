<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductOptionItemRequest;
use App\Http\Requests\UpdateProductOptionItemRequest;
use App\Http\Resources\ProductOptionItemResource;
use App\Models\ProductOption;
use App\Models\ProductOptionItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductOptionItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index($productOptionId): JsonResponse
    {
        $productOption = ProductOption::findOrFail($productOptionId);
        return $this->response(
            data: ProductOptionItemResource::collection($productOption->items)->toArray(request())
        );
    }

    public function show($productOptionId, $productOptionItemId): JsonResponse
    {
        $productOption = ProductOption::findOrFail($productOptionId);
        $productOptionItem = ProductOptionItem::findOrFail($productOptionItemId);
        if($productOptionItem->productOption->id == $productOptionId){
            return $this->response(
                data: $productOptionItem->toResource()->toArray(request())
            );
        }

        return $this->response(
            data: ProductOptionItemResource::collection($productOptionItem->items)->toArray(request())
        );
    }

    public function store(StoreProductOptionItemRequest $request, $productOptionId): JsonResponse
    {
        $productOption = ProductOption::findOrFail($productOptionId);
        $productOption->items()->create($request->validated());
        return $this->response(
            data: ProductOptionItemResource::collection($productOption->items)->toArray(request())
        );
    }

    public function update(UpdateProductOptionItemRequest $request, $productOptionId, $productOptionItemId): JsonResponse
    {
        $productOption = ProductOption::findOrFail($productOptionId);
        $productOptionItem = ProductOptionItem::findOrFail($productOptionItemId);
        if($productOptionItem->productOption->id == $productOptionId){
            $productOptionItem->update($request->validated());
            return $this->success(
                message: "Product option item updated successfully.",
                data: ProductOptionItemResource::collection($productOption->items)->toArray(request())
            );
        }

        return $this->error(
            message: "Product option item update failed."
        );
    }

    public function destroy($productOptionId, $productOptionItemId): JsonResponse
    {
        $productOption = ProductOption::findOrFail($productOptionId);
        $productOptionItem = ProductOptionItem::findOrFail($productOptionItemId);
        $user = auth()->user();

        $isOwner = $user->id === $productOption->product->restaurant->user_id;
        $isAdmin = $user->userRole->code === 'admin';
        $isRelated = $productOptionItem->product_option_id === $productOption->id;

        if(($isOwner || $isAdmin) && $isRelated){
            $productOptionItem->delete();
            return $this->success(
                message: "Product option item deleted successfully.",
                data: ProductOptionItemResource::collection($productOption->items)->toArray(request())
            );
        }

        return $this->error(
            message: "Product option item delete failed."
        );
    }
}
