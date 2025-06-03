<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeliveryResource;
use App\Models\Delivery;
use App\Models\OrderProduct;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Delivery::class);
    }

    public function index(): JsonResponse
    {
        $deliveries = auth()->user()->deliveries;
        return $this->response(
            data: DeliveryResource::collection($deliveries)->toArray(request()),
        );
    }

    public function show(Delivery $delivery): JsonResponse
    {
        return $this->response(
            data: $delivery->toResource()->toArray(request()),
        );
    }
}
