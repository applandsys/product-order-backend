<?php

namespace App\Contracts\Repositories;


use App\Models\Product;

interface ProductRepositoryInterface{
    public function getAllProducts();
    public function findProductById($id);

    public function createProduct(array $product);

    public function updateProduct(int $id,array $product);

    public function deleteProduct(int $id);

    public function updateStock(int $id,int $quantity);
}
