<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;

class CommentsController extends BaseController
{
    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function createComment(Request $request)
    {
        try {

            //$url = env('API_URL') . "comments";
            if (!Session::has('user') || Session::get('user') === null)
                return redirect()->back()->with('error', 'Vui lòng đăng nhập để bình luận !');
            
            $response = $this->client->post(
                env('API_URL') . 'comments',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                    'form_params' => [
                        'user_id' => $request->input('user_id'),
                        'new_id' => $request->input('new_id'),
                        'content' => $request->input('content')
                    ]
                ]
            );

            if ($response->getStatusCode() == 200) {
                return redirect()->back()->with('success', 'Thêm comment mới thành công!');
            } else if ($response->getStatusCode() == 400) {
                return redirect()->back()->with('error', 'Điền đầy đủ các trường');
            } else {
                return redirect()->back()->with('error', 'Thêm comment mới thất bại!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Thêm comment mới thất bại!');
        }
    }
}
