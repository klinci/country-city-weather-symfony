<?php

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\{Response,JsonResponse};

class ResponseWriterService
{

	public function error($param) {
		$message = [
			'error' => 1,
			'message' => $param
		];
		return new JsonResponse($message);
	}

	public function success($param) {
		$message = [
			'error' => 0,
			'message' => $param
		];
		return new JsonResponse($message);
	}

}