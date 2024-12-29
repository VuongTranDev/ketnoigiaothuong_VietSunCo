<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CommentsController extends BaseController
{
    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function createComment(Request $request)
    {
        //$url = env('API_URL') . "comments";

        $response = $this->client->post(env('API_URL').'comments',
        [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'user_id' =>$request->input('user_id'),
                'new_id' =>$request->input('new_id'),
                'content' =>$request->input('content')
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            return redirect()->back()->with('success', 'Thêm comment mới thành công!');
        }
        else if($response->getStatusCode() == 400)
        {
            return redirect()->back()->with('error', 'Điền đầy đủ các trường');
        }
        else
        {
            return redirect()->back()->with('error', 'Thêm comment mới thất bại!');
        }
    }





}
