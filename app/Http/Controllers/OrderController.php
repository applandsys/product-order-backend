<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Http\Resources\OrderResource;
use App\Repositories\OrderRepository;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $orderSrvice;

    public function __construct(OrderRepository $orderRepository, OrderService $orderService){
        $this->orderRepository = $orderRepository;
        $this->orderSrvice = $orderService;
    }
    public function index(){
        $orders = $this->orderRepository->getAllOrders();
        return OrderResource::collection($orders);
    }

    public function store(StoreOrderRequest $request){
        $order = $this->orderSrvice->createOrder($request->validated());
        return new OrderResource($order);
    }

    public function show($id){
        $order = $this->orderRepository->getWithItems($id);
    }

    public function updateStatus(UpdateOrderStatusRequest $request, $id)
    {
        if($request->status === 'cancelled'){
            $order = $this->orderSrvice->cancelOrder($id);
        }else{
            $order = $this->orderRepository->updateStatus($id,$request->status);
        }

        return new OrderResource($order);
    }
}
