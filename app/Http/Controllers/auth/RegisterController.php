<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $client = new Client();
        $response = $client->post(env('API_URL').'register', [
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
            return redirect()->route('auth.login')->withSuccess('Đăng ký tài khoản thành công');
        } else {
            return redirect()->back()->withErrors($data['errors'])->withInput();
        }
    }
}
