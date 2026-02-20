<?php

namespace App\Http\Controllers\Api\V1\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\Api\V1\Order\CreateOrderRequest;
use App\Http\Requests\Api\V1\Order\UpdateOrderItemRequest;
use App\Http\Requests\Api\V1\Order\UpdateOrderRequest;
use App\Http\Resources\Api\V1\Order\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    /**
     * Create a new order
     * 
     * @param CreateOrderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOrder(CreateOrderRequest $request)
    {
        // dd($request->validated());
        try {
            $order = Order::create($request->validated());
            return $this->success(new OrderResource($order), 'Order created successfully', 201);
        } catch (\Exception $e) {
            return $this->error('Failed to create order: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get paginated list of orders
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrders(Request $request)
    {
        try {
            $orderStatus = $request->query('status');
            $searchTerm  = $request->query('search');
            $page        = $request->query('page', 1);
            $perPage     = $request->query('per_page', 10);

            $orders = Order::when($orderStatus, function ($query, $status) {
                return $query->where('status', $status);
            })->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('$text', ['$search' => $searchTerm]);
            })->paginate($perPage, ['*'], 'page', $page);

            $data = [
                'orders' => OrderResource::collection($orders),
                'pagination' => [
                    'current_page' => $orders->currentPage(),
                    'per_page'     => $orders->perPage(),
                    'total'        => $orders->total(),
                    'last_page'    => $orders->lastPage(),
                ]
            ];
            return $this->success($data, 'Orders retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve orders: ' . $e->getMessage(), 500);
        }
    }


    /**
     * Update an existing order
     * 
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrder(UpdateOrderRequest $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->update($request->validated());
            return $this->success(new OrderResource($order), 'Order updated successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to update order: ' . $e->getMessage(), 500);
        }
    }


    /**
     * Update an existing order item
     * 
     * @param UpdateOrderItemRequest $request
     * @param string $orderId
     * @param string $itemId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrderItem(UpdateOrderItemRequest $request, $orderId, $itemId)
    {
        try {
            $order = Order::findOrFail($orderId);
            $updates = [];
            foreach ($request->validated() as $key => $value) {
                $updates["items.$.{$key}"] = $value;
            }

            DB::connection('mongodb')->getCollection('orders')->updateOne(
                [
                    '_id'       => new \MongoDB\BSON\ObjectId($orderId),
                    'items._id' => new \MongoDB\BSON\ObjectId($itemId),
                ],
                ['$set' => $updates]
            );

            return $this->success(new OrderResource($order->fresh()), 'Order item updated successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to update order item: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Delete an order 
     * 
     * @param string $orderId
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteOrder($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();
            return $this->success(null, 'Order deleted successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to delete order: ' . $e->getMessage(), 500);
        }
    }
}
