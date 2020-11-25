<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected function resp($success, $message = false, $statusCode = 200) {

		if( $success ) {
			$response = response()
				->json(['success' => true, 'message' => $message])
				->setStatusCode($statusCode);
		} else {
			$response = response()
				->json(['success' => false, 'message' => $message])
				->setStatusCode($statusCode);
		}

		return $response;

	}

}