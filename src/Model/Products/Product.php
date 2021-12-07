<?php

namespace App\Model\Products;

use Symfony\Component\Uid\Uuid;

class Product {

    protected string $name;
    protected int $quantity;
    protected int $price;
    protected Uuid $id;

    public function __construct(string $name, int $quantity, int $price, ?Uuid $id = null){
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->id = $id ?? Uuid::v4();
    }

    public function getName():string{
        return $this->name;
    }

    public function getQuantity():int{
        return $this->quantity;
    }

    public function getPrice():int{
        return $this->price;
    }

    public function getId():Uuid{
        return $this->id;
    }
}
?>