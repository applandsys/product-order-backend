<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;
use Nette\Schema\ValidationException;

class OrderService{
    protected $orderRepository;
    protected $productRepository;

    public function __construct(OrderRepository $orderRepository,ProductRepository $productRepository){
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    public function createOrder(array $data){
        return DB::transaction(function() use($data){
            foreach($data['items'] as $item){
                $product = $this->productRepository->findProductById($item['product_id']);

                if($product->stock_quantity >= $item['quantity']){
                    throw ValidationException::withMessages([
                        'items'=> "Insufficient Stock Quantity for {$product->name}"
                    ]);
                }
            }

            $totalAmount = 0;
            $orderItems = [];

            foreach($data['items'] as $item){
                $product = $this->productRepository->findProductById($item['product_id']);
                $subtotal = $item['quantity'] * $product->price;
                $totalAmount += $subtotal;

                $orderItems[] = [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'subtotal' => $subtotal,
                    'total' => $totalAmount,
                ];

                // Deduction
                $this->productRepository->updateStock($item['product_id'], $item['quantity']);

            }

            $order = $this->orderRepository->createOrder([
                'customer_name' => $data['customer_name'],
                'total_amount' => $totalAmount,
                'status' => $data['status'],
            ]);

            // Create Order Items
            foreach($orderItems as $orderItem){
                $order->orderItems()->create($orderItem);
            }
            return $this->orderRepository->getWithItems($order->id);
        });

    }

    public function cancelOrder(array $data){

    }

}
