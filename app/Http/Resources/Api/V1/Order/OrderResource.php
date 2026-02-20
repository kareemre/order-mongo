<?php

namespace App\Http\Resources\Api\V1\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'items' => collect($this->items)->map(function ($item) {
                return [
                    'id'           => isset($item['id']) ? (string) $item['id'] : null,
                    'product_name' => $item['product_name'] ?? null,
                    'product_id'   => $item['product_id'] ?? null,
                    'quantity'     => $item['quantity'] ?? null,
                    'price'        => $item['price'] ?? null,
                ];
            }),
            'total_amount'     => $this->total_amount,
            'shipping_address' => $this->shipping_address,
            'status'           => $this->status,
        ];
    }
}
