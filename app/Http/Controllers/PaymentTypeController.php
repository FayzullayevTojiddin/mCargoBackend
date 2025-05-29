<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentTypeResource;
use App\Models\PaymentType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class PaymentTypeController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(PaymentType::class);
    }

    public function index(): JsonResponse
    {
        $paymentTypes = PaymentTypeResource::collection(PaymentType::all())->toArray(request());
        return $this->response($paymentTypes);
    }

    public function store(PaymentRequest $request): JsonResponse
    {
        $paymentType = PaymentType::create($request->validated());
        return $this->success(
            message: 'Payment Type Created Successfully',
            data: $paymentType->toResource()->toArray(request()),
        );
    }

    public function update(PaymentRequest $request, PaymentType $paymentType): JsonResponse
    {
        $paymentType->update($request->validated());
        return $this->success(
            message: 'Payment Type Updated Successfully',
            data: $paymentType->toResource()->toArray(request()),
        );
    }

    public function destroy(PaymentType $paymentType): JsonResponse
    {
        $paymentType->delete();
        return $this->success(
            message: 'Payment Type Deleted Successfully',
            data: $paymentType->toResource()->toArray(request()),
        );
    }
}
