<?php

namespace App\Http\Controllers\partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CommentController extends Controller
{

    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function index($id)
    {
        return view('frontend.partner.news.comments.index', compact('id'));
    }


    public function changeStatus(Request $request)
    {
        $url = env('API_URL') . "comments/change-status";
        $response = $this->client->request(
            'POST',
            $url,
            [
                'form_params' => [
                    'id' => $request->id,
                    'status' => $request->status
                ]
            ]
        );

        if ($response->getStatusCode() == 200) {
            return response()->json(['message' => 'Cập nhật trạng thái thành công!']);
        } else {
            return response()->json(['message' => 'Cập nhật trạng thái thất bại!']);
        }
    }
}
