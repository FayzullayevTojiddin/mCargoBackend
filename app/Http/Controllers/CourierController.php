<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexCourierRequest;
use App\Http\Requests\StoreCourierRequest;
use App\Http\Resources\CourierResource;
use App\Models\Courier;
use App\Services\CourierService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class CourierController extends Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Courier::class);
    }

    public function index(IndexCourierRequest $request, CourierService $courierService): JsonResponse
    {
        $couriers = $courierService->getNearestCouriers(...$request->validated());

        return $this->response(
            data: CourierResource::collection($couriers)->toArray(request()),
        );
    }

    public function store(StoreCourierRequest $request): JsonResponse
    {
        $courier = Courier::create($request->validated());
        return $this->success(
            message: 'Courier created successfully',
            data: $courier->toResource()->toArray(request()),
        );
    }

    public function show(Courier $courier): JsonResponse
    {
        return $this->response(
            data: $courier->toResource()->toArray(request()),
        );
    }

    public function destroy(Courier $courier): JsonResponse
    {
        if($courier->delete()){
            return $this->success(
                message: 'Courier deleted successfully',
                data: $courier->toResource()->toArray(request()),
            );
        }

        return $this->error(
            message: 'Courier not deleted',
            data: $courier->toResource()->toArray(request()),
        );
    }
}
