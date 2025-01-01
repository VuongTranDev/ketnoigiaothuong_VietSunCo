<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RatingController extends BaseController
{
    public function createRating(Request $request)
    {
        Log::info('Allrequest', $request->all());

        if (!Session::has('user') || Session::get('user') === null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vui lòng đăng nhập để đánh giá công ty',
            ]);
        }
        $userId = Session::get('user')->id;

        $company= $this->fetchDataFromApi("checkCompanyWithStatus/{$userId}");
        if($company===0)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Chỉ có tài khoản đã đăng ký công ty và công ty còn hoạt động mới được đánh giá',
            ]);
        }

        $client = new Client();
        $response = $client->post(env('API_URL') . 'rating', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'content' => $request->content,
                'numberstart' => $request->numberstart,
                'company_id' => $request->company_id,
                'user_id' => $userId,
            ]
        ]);

        $data = json_decode($response->getBody());

        if ($data->status == 'success') {
            return response()->json([
                'status' => 'success',
                'message' => 'Đánh giá thành công',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $data->errors ?? 'Đã xảy ra lỗi',
            ]);
        }
    }
}
