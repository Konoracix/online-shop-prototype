<?php
	namespace App\Controller;

	use Symfony\Component\Serializer\SerializerInterface;
	use Symfony\Component\Uid\Uuid;
	use Symfony\Component\Uid\UuidV4;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Request;

	abstract class Controller{

		protected SerializerInterface $serializer;

		public function __construct(SerializerInterface $serializer){
			$this->serializer = $serializer;
		}

		public abstract function getAction(Request $request): Response;

		public abstract function postAction(Request $request): Response;

		public abstract function getOneAction(string $id): Response;
		
		public abstract function putAction(string $id, Request $request): Response;

		public abstract function deleteAction(string $id): Response;

		protected function isUuidV4(string $uuid): bool{
			$uuidCheck = Uuid::fromString($uuid);
			return ($uuidCheck instanceof UuidV4);
		} 
		
		/**
		 * @param object[]|object $data
		 */
		protected function createResponse($data, int $httpCode): Response { 
			return new Response(
				$this->serializer->serialize($data, 'json'),
				$httpCode,
				['Content-Type' => 'application/json; charset=utf-8']
			);
		}
	}
?>