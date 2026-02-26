<?php
namespace App\Contracts\Repositories;

interface OrderRepositoryInterface{
    public function getAllOrders();
    public function getOrderById($id);
    public function createOrder(array $data);
    public function updateStatus($id, string $status);
    public function getWithItems($id);
}
