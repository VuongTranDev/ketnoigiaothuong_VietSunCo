<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $client = new Client();
        $response = $client->post(env('API_URL') . 'login', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
            ]
        ]);
        $data = json_decode($response->getBody());
        if ($data->status == 'success') {
            $token = $client->get(env('API_URL') . 'user', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $data->token,
                ]
            ]);
            $token_info = json_decode($token->getBody());
            Session::put('token', $data->token);
            Session::put('user', $token_info);
            return redirect()->route('home')->withSuccess('Đăng nhập thành công!');
        } else {
            return redirect()->back()->withErrors($data['errors'])->withInput();
        }
    }


    public function loginGoole()
    {
        $client = new Client();

        try {
            // Gửi yêu cầu đến API để lấy URL đăng nhập Google
            $response = $client->get(env('API_URL') . 'get-google-sign-in-url', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);
            $data = json_decode($response->getBody());

            if ($data->status == 'success') {
                // Chuyển hướng người dùng đến URL đăng nhập Google
                return redirect()->away($data->data); // `data` chứa URL đăng nhập Google
            } else {
                return redirect()->back()->withErrors(['error' => 'Không lấy được URL đăng nhập Google.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Đã xảy ra lỗi khi kết nối đến API: ' . $e->getMessage()]);
        }
    }


    public function clearSession()
    {
        Session::forget('token');
        Session::forget('user');
        return redirect()->route('home')->withSuccess('Đã xóa session');
    }

    public function logout(Request $request)
    {
        $client = new Client();
        $token = Session::get('token');
        if (!$token) {
            return redirect()->back()->withErrors(['error' => 'Vui lòng đăng nhập'])->withInput();
        }
        $response = $client->post(env('API_URL') . 'logout', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        $data = json_decode($response->getBody());
        if ($data->status === 'success') {
            Session::flush() ;
            Session::forget('token');
            Session::forget('user');
            Auth::guard('web')->logout();
            return redirect()->route('home')->withSuccess('Đăng xuất thành công!');
        } else {
            return redirect()->back()->withErrors($data['errors'])->withInput();
        }
    }
}
