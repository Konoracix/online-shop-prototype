<?php

namespace App\Model\User;

use App\Model\Location\Adress;
use Symfony\Component\Uid\Uuid;

class User {
    private string $firstName;
    private string $lastName;
    private Adress $homeAdress;
    private \DateTimeImmutable $dateOfBirth;
    private Uuid $id;

    public function __construct(string $firstName, string $lastName, Adress $homeAdress, \DateTimeImmutable $dateOfBirth, ?Uuid $id){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->homeAdress = $homeAdress;
        $this->dateOfBirth = $dateOfBirth;
        $this->id = $id ?? Uuid::v4();

    }

    public function getFirstName():string{
        return $this->firstName;
    }

    public function getLastName():string{
        return $this->lastName;
    }

    public function getHomeAdress():Adress{
        return $this->homeAdress;
    }

    public function getDateOfBirth():\DateTimeImmutable{
        return $this->dateOfBirth;
    }

    public function getId():Uuid {
        return $this->id;
    }
}

?>