<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    protected $client;
    protected $url;
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->url = env('API_URL');
    }
    public function index()
    {

        $userId = Auth::id();
        $token = session()->get('token');
        if (!$token) {
            return redirect()->route('login')->withErrors('Bạn cần đăng nhập để tiếp tục.');
        }

        try {
            $response = $this->client->get($this->url . 'messages/user/' . $userId, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            $messages = json_decode($response->getBody()->getContents());
            return view('frontend.partner.message.index', compact('messages'));
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return redirect()->back()->withErrors('Không thể lấy danh sách tin nhắn. Vui lòng thử lại.');
        } catch (\Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());
            return redirect()->back()->withErrors('Đã xảy ra lỗi. Vui lòng thử lại sau.');
        }
    }
    public function getMessages(Request $request)
    {
        try {
            $response = $this->client->get($this->url . 'messages/' . $request->id, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session()->get('token'),
                ]
            ]);
            $messages = json_decode($response->getBody()->getContents());
            Log::info('Get messages: ' . json_encode($messages));

            return response()->json([
                'status' => 'success',
                'data' => $messages,
            ]);
        } catch (\Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());
            return redirect()->back()->withErrors('Đã xảy ra lỗi. Vui lòng thử lại sau.');
        }
    }
    public function sendMessage(Request $request)
    {
        try {
            $request->validate([
                'message' => ['required'],
                'receiver_id' => ['required']
            ]);
            $response = $this->client->post($this->url . 'messages/send', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session()->get('token'),
                ],
                'form_params' => [
                    'receiver_id' => $request->receiver_id,
                    'content' => $request->message,
                ]
            ]);
            $data = json_decode($response->getBody()->getContents());
            return response()->json([
                'status' => 'success',
                'message' => 'Gửi tin nhắn thành công.',
                'data' => $data->data,
            ]);
        } catch (\Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi. Vui lòng thử lại sau.'
            ]);
        }
    }
    public function maskAsRead(Request $request)
    {
        try {
            $response = $this->client->post($this->url . 'messages/' . $request->receiver_id . '/read', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session()->get('token'),
                ],
            ]);

            $data = json_decode($response->getBody()->getContents());


            return response()->json([
                'status' => 'success',
                'message' => 'Đã đánh dấu là đã đọc.',
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không thể đánh dấu là đã đọc. Vui lòng thử lại.',
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi. Vui lòng thử lại sau.',
            ], 500);
        }
    }
    public function fillInformation(Request $request)
    {
        $request->validate([
            'company' => 'required|integer',
        ]);

        try {
            $response = $this->client->get(
                $this->url . 'getCompanyByUser',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . session()->get('token'),
                    ],
                    'query' => [
                        'company_a' => $request->company,
                        'company_b' => Auth::id(),
                    ]
                ]
            );
            $data = json_decode($response->getBody()->getContents());

            return response()->json([
                'status' => 'success',
                'data' => $data->data,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in fillInformation: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred. Please try again later.',
            ], 500);
        }
    }
    public function createTransaction(Request $request)
    {
        $request->validate(
            [
                'receiver_id' => 'required|integer',
                'title' => 'required|string',
                'content' => 'required|string',
                'date_meet' => 'required|date',
                'address' => 'required|string',
            ],
            [
                'date_meet.date' => 'Bắt buộc là ngày tháng.',
            ]
        );
        try {
            $response = $this->client->post($this->url . 'createTransaction', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session()->get('token'),
                ],
                'form_params' => [
                    'receiver_id' => $request->receiver_id,
                    'title' => $request->title,
                    'content' => $request->content,
                    'date_meet' => $request->date_meet,
                    'address' => $request->address,
                ]
            ]);
            $data = json_decode($response->getBody()->getContents());
            return response()->json([
                'status' => 'success',
                'message' => $data->message,
                'data' => $data->data,
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error in createTransaction: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred. Please try again later.',
            ], 500);
        }
    }
    public function getTransaction(Request $request) {

        try
        {
            $response = $this->client->get($this->url . 'getTransaction/'.$request->receiver_id, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session()->get('token'),
                ]
            ]);
            $data = json_decode($response->getBody()->getContents());
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ]);
        }
        catch(\Exception $e){
            \Log::error('Error in checkTransaction: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred. Please try again later.',
                ], 500);

        }
    }
}
