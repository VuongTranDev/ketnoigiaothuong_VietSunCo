<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    // public function success($data = [], $code, $message)
    // {
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => $message,
    //         'data' => $data,

    //     ], $code);
    // }
    public function failed($message = "error", $error = [], $code = 500)
    {
        return response()->json([
            'status' => "error",
            'message' => $message,

        ], $code);
    }

    public function exception($message, $errors, $code)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $code);
    }

    public function successWithPagination($paginate ,$data, $code)
    {
        return response()->json([
            'status' => 'success',
            'paginate' => $paginate,
            'data' => $data,
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
