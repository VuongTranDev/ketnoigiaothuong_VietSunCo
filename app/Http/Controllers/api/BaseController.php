<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function failed($message = "error", $error = [], $code = 500)
    {
        return response()->json([
            'status' => "error",
            'message' => $message,
            'error' => $error,
        ], $code);
    }

    public function success($data = [], $message = "success", $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => $message,
        ], $code);
    }
}
