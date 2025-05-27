<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderProductResource;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductOptionItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(): JsonResponse
    {
        $orders = OrderProductResource::collection(auth()->user()->orders);
        return $this->response($orders->toArray(request()));
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
      $calculatedTotal = 0;

      foreach ($request->input('products') as $product) {
          $productModel = Product::findOrFail($product['product_id']);
          $lineTotal = $productModel->price * $product['quantity'];

          foreach ($product['options'] ?? [] as $option) {
              $optionItem = ProductOptionItem::findOrFail($option['item_id']);
              if($optionItem->productOption->product->id == $productModel->id) {
                  $lineTotal += $optionItem->price * $product['quantity'];
              }else{
                  return $this->error('Not found this item for this product');
              }
          }

          $calculatedTotal += $lineTotal;
      }

      return $this->response([$calculatedTotal]);
    }

    public function show($orderProductId): JsonResponse
    {
        $orderProduct = OrderProduct::findOrFail($orderProductId);
        return $this->response($orderProduct->toResource()->toArray(request()));
    }
}
