<?php

namespace App\Http\Controllers;

use App\Http\Resources\IndexCategoriesResource;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestaurantCategoriesController extends Controller
{
    public function index($restaurantId)
    {
        $restaurant = Restaurant::find($restaurantId);
        return IndexCategoriesResource::collection($restaurant->categories);
    }
}
