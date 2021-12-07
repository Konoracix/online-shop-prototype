<?php

namespace App\Model\Products;

class ProductCollection {

    protected array $products;

    public function __construct(array $products) {
        $this->products = $products;
    }

    public function toArray():array{
        return $this->products;
    }

    public function addProduct(Product $product){
        $this->products[] = $product;
    }

    public function removeProduct(Product $product){
        //to do
    }
    public function getProducts():array {
        return $this->products;
    }
    
}




?>