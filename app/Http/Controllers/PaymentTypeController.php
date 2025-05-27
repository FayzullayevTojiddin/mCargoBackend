<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentTypeResource;
use App\Models\PaymentType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    public function index(): JsonResponse
    {
        $paymentTypes = PaymentTypeResource::collection(PaymentType::all())->toArray(request());
        return $this->response($paymentTypes);
    }
}
