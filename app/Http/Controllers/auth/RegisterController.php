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
        try {
            $client = new Client();
            $response = $client->post(env('API_URL').'register', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'email' => $request->email,
                    'password' => $request->password,
                ],
            ]);

            $data = json_decode($response->getBody());

            if (isset($data->status) && $data->status == true) {
                flash('Đăng kí thành công', 'success');
                return redirect()->route('auth.login');
            } else {
                return redirect()->back()->withErrors($data->errors ?? 'Đăng ký thất bại')->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Có lỗi xảy ra, vui lòng thử lại sau.')->withInput();
        }
    }

}
