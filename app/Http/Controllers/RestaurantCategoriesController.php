<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriesProductRequest;
use App\Http\Requests\UpdateCategoriesProductRequest;
use App\Http\Resources\IndexCategoriesResource;
use App\Http\Resources\IndexProductResource;
use App\Models\ProductCategory;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
class RestaurantCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index($restaurantId)
    {
        $restaurant = Restaurant::find($restaurantId);
        return IndexCategoriesResource::collection($restaurant->categories);
    }

    public function show($restaurantId, $categoryId): JsonResponse
    {
        $category = ProductCategory::findOrFail($categoryId);
        if($category->restaurant_id == $restaurantId){
            return $this->response(
                data: IndexProductResource::collection($category->products)->toArray(request()),
            );
        }

        return $this->error(
            message: "Not found this category",
        );
    }

    public function store(StoreCategoriesProductRequest $request, $restaurantId): JsonResponse
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $restaurant->categories()->create($request->validated());
        return $this->success(
            message: "Restaurant category added successfully",
            data: IndexCategoriesResource::collection($restaurant->categories)->toArray(request()),
        );
    }

    public function update(UpdateCategoriesProductRequest $request, $restaurantId, $categoryId): JsonResponse
    {
        $category = ProductCategory::findOrFail($categoryId);
        $category->update($request->validated());
        return $this->success(
            message: "Restaurant category updated successfully",
            data: IndexCategoriesResource::collection($category->products)->toArray(request()),
        );
    }

    public function destroy($restaurantId, $categoryId): JsonResponse
    {
        $user = auth()->user();
        $restaurant = Restaurant::findOrFail($restaurantId);
        if ($restaurant->user_id == $user->id || $user->userRole->code === 'admin') {
            $restaurant->categories()->findOrFail($categoryId)->delete();
            return $this->success(
                message: "Restaurant category deleted successfully",
                data: IndexCategoriesResource::collection($restaurant->categories)->toArray(request()),
            );
        }

        return $this->error(
            message: "Not found this category",
        );
    }
}
