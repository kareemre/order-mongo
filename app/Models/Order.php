<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'orders';

    protected $fillable = [
        'user_id',
        'items',
        'total_amount',
        'shipping_address',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            if (!empty($order->items)) {
                $order->items = array_map(function ($item) {
                    if (empty($item['id'])) {
                        $item['id'] = new \MongoDB\BSON\ObjectId();
                    }
                    return $item;
                }, $order->items);
            }
        });
    }
}
