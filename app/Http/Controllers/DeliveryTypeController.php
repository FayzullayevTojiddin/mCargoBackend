<?php

namespace App\Http\Controllers;

use App\Models\DeliveryType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeliveryTypeController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(DeliveryType::class);
    }

    public function index(): JsonResponse
    {
        $deliveryTypes = DeliveryType::all();
        return $this->response(
            data: $deliveryTypes->toArray(request()),
        );
    }
}
