<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    public function response(array $data = []): JsonResponse
    {
        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function success($message, array $data = [], $status = 201): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message ?? "Operation successful",
            'data' => $data,
        ], $status);
    }

    public function error($message, array $data = [], $status = 401): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message ?? "Operation failed",
            'data' => $data,
        ], $status);
    }
}
