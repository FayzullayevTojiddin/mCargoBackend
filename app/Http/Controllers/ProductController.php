<?php

namespace App\Http\Controllers;

use App\Http\Resources\IndexProductResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Restaurant $restaurant): JsonResponse
    {
        return $this->response(IndexProductResource::collection($restaurant->products)->toArray(request()));
    }

    public function show(Restaurant $restaurant, Product $product): JsonResponse
    {
        return $this->response($product->toResource()->toArray(request()));
    }
}
