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
        $response = $client->post(env('HTTP_API_URL').'login', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
            ]
        ]);
        $data = json_decode($response->getBody(), true);
        if ($data['status'] == 'success') {
            return redirect()->route('/')->withSuccess('Đăng nhập thành công!');
        } else {
            return redirect()->back()->withErrors($data['errors'])->withInput();
        }
    }
    public function logout(Request $request)
    {
        $client = new Client();
        $token = "2Isc8V60tvLdW7LHdcOnT1bnhbQuim6tshlmTBqCaYwEbAbHOiPvjhxIvxhz";

        if (!$token) {
            return redirect()->back()->withErrors(['error' => 'Vui lòng đăng nhập'])->withInput();
        }

        $response = $client->post(env('HTTP_API_URL').'logout', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        if ($data['status'] == 'success') {

            Session::forget('token_info');
            Session::forget('user_name');
            Auth::guard('web')->logout();

            return redirect()->route('home')->withSuccess('Đăng xuất thành công!');
        } else {
            return redirect()->back()->withErrors($data['errors'])->withInput();
        }
    }
}
