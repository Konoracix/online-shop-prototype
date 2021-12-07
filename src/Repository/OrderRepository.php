<?php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Model\Order\Order;

class OrderRepository extends ServiceEntityRepository{
	public function __construct(ManagerRegistry $registry){
		parent::__construct($registry, Order::class);
	}

	public function saveObject(Order $object):void{
		$this->_em->persist($object);
		$this->_em->flush($object);
	}

	public function deleteObject(Order $object):void {
		$this->_em->remove($object);
		$this->_em->flush();
	}
}
?>