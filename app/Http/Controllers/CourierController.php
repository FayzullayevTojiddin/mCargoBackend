<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Services\CourierService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Courier::class);
    }

    public function index(Request $request, CourierService $courierService): JsonResponse
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $couriers = $courierService->getNearestCouriers(
            $request->input('latitude'),
            $request->input('longitude')
        );

        return response()->json($couriers);
    }
}
