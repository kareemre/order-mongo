<?php

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-mongo', function () {
    Order::create([
        'user_id' => 1,
        'items' => [
            [
                'product_id' => 101,
                'product_name' => 'Laptop',
                'quantity' => 1,
                'price' => 999.99,
                'subtotal' => 999.99
            ],
            [
                'product_id' => 102,
                'product_name' => 'Mouse',
                'quantity' => 2,
                'price' => 25.00,
                'subtotal' => 50.00
            ]
        ],
        'total_amount' => 1049.99,
        'status' => 'pending',
        'shipping_address' => [
            'street' => '123 Main St',
            'city' => 'New York',
            'zip' => '10001'
        ],
        // 'payment_method' => 'credit_card'
    ]);
});
