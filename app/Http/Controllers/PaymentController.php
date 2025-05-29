<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Payment::class);
    }

    public function index(): JsonResponse
    {
        $payments = PaymentResource::collection(auth()->user()->payments)->toArray(request());
        return $this->response(
            data: $payments
        );
    }

    public function store(StorePaymentRequest $request): JsonResponse
    {
        $payment = auth()->user()->payments()->create($request->validated())->fresh();
        return $this->success(
            message: "Payment created successfully.",
            data: $payment->toResource()->toArray(request())
        );
    }

    public function show(Payment $payment): JsonResponse
    {
        return $this->response(
            data: $payment->toResource()->toArray(request()),
        );
    }
}
