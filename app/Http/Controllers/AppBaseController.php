<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class AppBaseController extends Controller
{
    public function sendResponse($result, $message, $errorMessage)
    {
        return Response::json([
            'success' => true,
            'data' => $result,
            'message' => $message,
            'errorMessage' => $errorMessage,
        ]);
    }

    public function sendError($result, $message, $errorMessage)
    {
        return Response::json([
            'success' => true,
            'data' => $result,
            'message' => $message,
            'errorMessage' => $errorMessage,
        ]);
    }

    public function sendSuccess($result, $message, $errorMessage)
    {
        return Response::json([
            'success' => true,
            'data' => $result,
            'message' => $message,
            'errorMessage' => $errorMessage,
        ]);
    }
}
