<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BasketController;
use App\Http\Controllers\Api\V1\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login')->withoutMiddleware(['auth:api']);
        Route::post('register', 'register')->withoutMiddleware(['auth:api']);
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });
});

Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::post('products-import', [ProductController::class, 'csvImport']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::post('/products/brand/{id}', [ProductController::class, 'store']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    Route::get('/baskets', [BasketController::class, 'getBasket']);
    Route::post('/baskets/product/{id}', [BasketController::class, 'addToBasket']);
    Route::delete('/baskets/product/{id}', [BasketController::class, 'removeFromBasket']);

    Route::post('/orders', [OrderController::class, 'createOrder']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders-cancel/{id}', [OrderController::class, 'cancelOrder']);
    Route::delete('/orders/{id}', [OrderController::class, 'removeOrder']);
    Route::post('/orders-done/{id}', [OrderController::class, 'finalizeOrder']);
});
