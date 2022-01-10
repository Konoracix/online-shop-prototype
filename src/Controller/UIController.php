<?php

	namespace App\Controller;

	use App\Controller\OrderController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Request;
	use App\Repository\FilterFactory;
	use Symfony\Component\HttpFoundation\InputBag;

	class UIController extends OrderController{

		public function getAction(Request $request): Response{
			$filterFactory = new FilterFactory();
			$queries = new InputBag();
			$orders = $filterFactory->create($queries, $request, $this->orderRepository, 'price');
	
			return $this->render("Views/OrderListView.html.twig", [
				"value"=>$orders
			]);
		}
	}
?>