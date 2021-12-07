<?php

namespace App\Model\Order;

use App\Model\Products\ProductCollection;
use App\Model\User\User;
use App\Model\Location\Adress;
use Symfony\Component\Uid\Uuid;

class Order {

    private Uuid $id;
    private ?ProductCollection $products = NULL;
    private int $price;
    private ?User $recipient = NULL;
    private ?Adress $deliveryAdress = NULL;
    private ?\DateTimeImmutable $deliveryTime = NULL;
    private \DateTimeImmutable $orderPlacementTime;
    private ?\DateTime $deletedAt = NULL; 

    public function __construct(
        ?Uuid $id, 
        ?ProductCollection $products = NULL,
        int $price, 
        ?User $recipient = NULL, 
        ?Adress $deliveryAdress = NULL, 
        ?\DateTimeImmutable $deliveryTime = NULL, 
        ?\DateTimeImmutable $orderPlacementTime = NULL
        ) {
        $this->id = $id ?? Uuid::v4();
        $this->products = $products;
        $this->price = $price;
        $this->recipient = $recipient;
        $this->deliveryAdress = $deliveryAdress;
        $this->deliveryTime = $deliveryTime;
        $this->orderPlacementTime = $orderPlacementTime ?? new \DateTimeImmutable();
    }

    public function getId():Uuid {
        return $this->id;
    }

    public function getProducts():?ProductCollection{
        return $this->products;
    }

    public function getPrice():int{
        return $this->price;
    }

    public function getRecipient():?User{
        return $this->recipient;
    }

    public function getDeliveryAdress():?Adress{
        return $this->deliveryAdress;
    }

    public function getDeliveryTime():?\DateTimeImmutable {
        return $this->deliveryTime;
    }

    public function getOrderPlacementTime():\DateTimeImmutable {
        return $this->orderPlacementTime;
    }

    public function update(Order $updatedOrder): Order {
        $this->price = $updatedOrder->getPrice();
        return $this;
    }
}





?>