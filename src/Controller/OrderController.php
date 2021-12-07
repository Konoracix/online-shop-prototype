<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Model\Order\Order;
use Symfony\Component\HttpFoundation\InputBag;
use App\Repository\FilterFactory;
use App\Model\Products\ProductCollection;
use App\Model\Products\Product;
use App\Model\User\User;
use App\Model\Location\Adress;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController{

	private SerializerInterface $serializer;
	private OrderRepository $orderRepository;

	public function __construct(SerializerInterface $serializer, OrderRepository $orderRepository) {
		$this->serializer = $serializer;
		$this->orderRepository = $orderRepository;
	}

	public function getAction(Request $request){
		$filterFactory = new FilterFactory();
		$queries = new InputBag();
		$orders = $filterFactory->create($queries, $request, $this->orderRepository, 'price');
		return new Response(
			$this->serializer->serialize($orders, 'json'),
			Response::HTTP_OK,
			['Content-Type' => 'application/json; charset=utf-8']
		);
	}
	public function postAction(Request $request){
		
		$order = $this->createOrderFromRequest($request);

		$this->orderRepository->saveObject($order);
		return new Response(
			$this->serializer->serialize($order, 'json'),
			Response::HTTP_OK,
			['Content-Type' => 'application/json; charset=utf-8']
		);
	}

	public function getOneAction(string $id){
		$uuid = Uuid::fromString($id);
		$order = $this->orderRepository->find($uuid);
		if(!$order instanceof Order){
			throw new NotFoundHttpException();
		}
		return new Response(
			$this->serializer->serialize($order, 'json'),
			Response::HTTP_OK,
			['Content-Type' => 'application/json; charset=utf-8']
		);
	}

	public function putAction(string $id, Request $request) {
		$uuid = Uuid::fromString($id);
		$order = $this->orderRepository->find($uuid);
		if(!$order instanceof Order) {
			throw new NotFoundHttipException();
		}
		$updatedOrder = $this->createOrderFromRequest($request);
		$this->orderRepository->saveObject($order->update($updatedOrder));
		return new Response(
			$this->serializer->serialize($updatedOrder, 'json'),
			Response::HTTP_OK,
			['Content-Type' => 'application/json; charset=utf-8']
		);
	}

	private function createOrderFromRequest(Request $request): Order {
		$data = $request->toArray();

		$adress = new Adress($data['user']['adress']['country'], $data['user']['adress']['city'], $data['user']['adress']['street'], $data['user']['adress']['houseNumber'], NULL, NULL, Uuid::fromString($data['user']['adress']['id']));
		$dateOfBirth = new \DateTimeImmutable($data['user']['dateOfBirth']);
		$deliveryTime = new \DateTimeImmutable($data['deliveryTime']);
		$user = new User($data['user']['firstName'], $data['user']['lastName'], $adress, $dateOfBirth, Uuid::fromString($data['user']['id']));
		$order = new Order(Uuid::fromString($data['id']), NULL, $data['price'], $user, $adress, $deliveryTime, NULL);

		return $order;
	}

	public function deleteAction(string $id): Response {
		$uuid = Uuid::fromString($id);
		$order = $this->orderRepository->find($uuid);
		if(!$order instanceof Order) {
			throw new NotFoundHttpException;
		}
		$this->orderRepository->deleteObject($order);
		return new Response(
			'',
			Response::HTTP_OK,
			['Content-Type' => 'application/json; charset=utf-8']
		);
	}
}
?>