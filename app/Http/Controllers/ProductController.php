<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }

    public function index(){
        $products = $this->productRepository->getAllProducts();
        return ProductResource::collection($products);
    }

    public function show($id){
        $product = $this->productRepository->findProductById($id);
    }



}
