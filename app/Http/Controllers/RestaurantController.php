<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\RestaurantShowResource;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request): JsonResponse
    {
        $lat = $request->input('latitude');
        $lng = $request->input('longitude');
        $radius = $request->radius ?? 10;
        if ($lat && $lng) {
            $restaurants = Restaurant::nearby($lat, $lng, $radius)->get();
        }else{
            $restaurants = Restaurant::all();
        }
        return $this->response(
            RestaurantResource::collection($restaurants)->toArray(request())
        );
    }

    public function show(Restaurant $restaurant): JsonResponse
    {
        $data = new RestaurantShowResource($restaurant);
        return $this->response($data->toArray(request()));
    }

    public function store(StoreRestaurantRequest $request): JsonResponse
    {
        $restaurant = Restaurant::create([...$request->validated()]);

        if($restaurant) {
            return $this->success(
                message: 'Restaurant created successfully',
                data: $restaurant->toResource(RestaurantShowResource::class)->toArray(request())
            );
        }

        return $this->error(
            message: 'Restaurant not created',
        );
    }

    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant): JsonResponse
    {
        if($restaurant->update([...$request->validated()])){
            return $this->success(
                message: 'Restaurant updated successfully',
                data: $restaurant->toResource(RestaurantShowResource::class)->toArray(request())
            );
        }

        return $this->error(
            message: 'Restaurant not updated',
        );
    }

    public function destroy(Restaurant $restaurant): JsonResponse
    {
        if (auth()->user()->userRole->code !== "admin") {
            return $this->error(message: 'Restaurant not found');
        }

        return $restaurant->delete()
            ? $this->success(
                message: 'Restaurant deleted successfully',
                data: $restaurant->toResource(RestaurantShowResource::class)->toArray(request())
            )
            : $this->error(message: 'Restaurant not deleted');
    }
}
