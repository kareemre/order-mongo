<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::post('/orders', [App\Http\Controllers\Api\V1\Order\OrderController::class, 'createOrder']);
    Route::patch('/orders/{id}', [App\Http\Controllers\Api\V1\Order\OrderController::class, 'updateOrder']);
    Route::patch('/orders/{orderId}/items/{itemId}', [App\Http\Controllers\Api\V1\Order\OrderController::class, 'updateOrderItem']);
    Route::delete('/orders/{orderId}/{itemId}', [App\Http\Controllers\Api\V1\Order\OrderController::class, 'deleteOrderItem']);
    Route::delete('/orders/{id}', [App\Http\Controllers\Api\V1\Order\OrderController::class, 'deleteOrder']);
    Route::get('/orders', [App\Http\Controllers\Api\V1\Order\OrderController::class, 'getOrders']);
});