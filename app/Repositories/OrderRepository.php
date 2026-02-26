<?php
namespace App\Repositories;

use App\Contracts\Repositories\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface{

    public function getAllOrders()
    {
        // TODO: Implement getAllOrders() method.
        return Order::with('orderItems.product')->all();
    }

    public function getOrderById($id)
    {
        // TODO: Implement getOrderById() method.
        return Order::with('orderItems.product')->find($id);
    }

    public function createOrder(array $data)
    {
        // TODO: Implement createOrder() method.
        DB::transaction(function() use($data){
            return Order::create($data);
        });
    }

    public function updateStatus($id, string $status)
    {
        // TODO: Implement updateStatus() method.
    }

    public function getWithItems($id)
    {
        // TODO: Implement getWithItems() method.
        $order = $this->getOrderById($id);
        return $order->update('orderItems.product')->findOrFail($id);
    }
}
