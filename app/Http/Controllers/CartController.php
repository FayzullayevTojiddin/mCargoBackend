<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(): JsonResponse
    {
        $cart = auth()->user()->cart;
        $cartItems = $cart?->items;
        return $this->response(
            [$cartItems],
        );
    }
}
