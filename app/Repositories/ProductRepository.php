<?php
namespace App\Repositories;

use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface{

    public function getAllProducts()
    {
        // TODO: Implement getAllProducts() method.
        return Product::all();
    }

    public function findProductById($id)
    {
        // TODO: Implement findProductById() method.
        return Product::findOrFail($id);
    }

    public function createProduct(array $product)
    {
        // TODO: Implement createProduct() method.
        return Product::create($product);
    }

    public function updateProduct(int $id, array $product)
    {
        // TODO: Implement updateProduct() method.
        $product = $this->findProductById($id);
        $product->update($product);
        return $product;
    }

    public function deleteProduct(int $id)
    {
        // TODO: Implement deleteProduct() method.
        $product = $this->findProductById($id);
        $product->delete();
    }

    public function updateStock(int $id, int $quantity)
    {
        // TODO: Implement updateStock() method.
        return  $this->findProductById($id)->update(['stock_quantity' => $quantity]);
    }
}
