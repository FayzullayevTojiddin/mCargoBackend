<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\DeliveryTypeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOptionController;
use App\Http\Controllers\ProductOptionItemController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\RestaurantCategoriesController;
use App\Http\Controllers\RestaurantReviewController;
use App\Http\Controllers\UserCardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;


Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('register', [UserController::class, 'register']);
Route::get('user', [UserController::class, 'getUser'])->middleware('auth:sanctum');


Route::apiResources(array(
    'restaurants' => RestaurantController::class,
    'restaurant.products' => ProductController::class,
    'restaurant.categories' => RestaurantCategoriesController::class,
    'restaurant.reviews' => RestaurantReviewController::class,
    'product.reviews' => ProductReviewController::class,
    'orders' => OrderController::class,
    'user-cards' => UserCardController::class,
    'payments' => PaymentController::class,
    'payment-types' => PaymentTypeController::class,
    'images' => ImageController::class,
    'product.options' => ProductOptionController::class,
    'option.items' => ProductOptionItemController::class,
    'cart' => CartController::class,
    'delivery-types' => DeliveryTypeController::class,
    'couriers' => CourierController::class,
));
