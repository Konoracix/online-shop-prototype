<?php

namespace App\Model\Location;

use Symfony\Component\Uid\Uuid;

class Adress {

	private string $country;
	private string $city;
	private string $street;
	private string $houseNumber;
	private ?string $ZIPCode;
	private ?string $state;
	private Uuid $id;

	public function __construct(
		string $country,
		string $city,
		string $street,
		string $houseNumber, 
		?string $ZIPCode,
		?string $state,
		?Uuid $id
	){
		$this->country = $country;
		$this->city = $city;
		$this->street = $street;
		$this->houseNumber = $houseNumber;
		$this->ZIPCode = $ZIPCode;
		$this->state = $state;
		$this->id = $id ?? Uuid::v4();
	}

	public function getCountry():string{
		return $this->country;
	}
	
	public function getCity():string{
		return $this->city;
	}

	public function getStreet():string{
		return $this->street;
	}

	public function getHouseNumber():string{
		return $this->houseNumber;
	}

	public function getZIPCode():?string{
		return $this->ZIPCode;
	}

	public function getState():?string{
		return $this->state;
	}
}

?>