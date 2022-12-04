<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseController extends Controller
{

    public function sendResponse($result, $message, $status=200) {
    	$response = [
            'success' => true,
            'status' => $status,
            'data'    => $result,
        ];
        $response['message'] = $message;
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $status = 200) {
    	$response = [
            'success' => false,
            'status' => $status,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $status);

    }
}
