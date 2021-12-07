<?php

namespace App\Repository;

use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;

class FilterFactory{

	public function create(InputBag $queries, Request $request, OrderRepository $orderRepository, string $queryCriterias){
		$criterias = $request->query->get($queryCriterias);
		$orders = $criterias == NULL ?
			$orderRepository->findAll() : $orderRepository->findBy([$queryCriterias=>$criterias]);
		return $orders;
	}
}
?>