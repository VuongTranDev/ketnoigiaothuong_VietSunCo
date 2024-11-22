<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Socialite;

class LoginGoogleController extends Controller
{
    protected $client;
    protected $url;
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->url = env('API_URL');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $response = $this->client->request('GET', $this->url . 'auth/callback/google', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                ]

            ]);

            $apiResponse = json_decode($response->getBody()->getContents());
            if ($apiResponse->status === 'success') {
                Session::put('token', $apiResponse->token);
                Session::put('user', $apiResponse->user);

                return redirect()->route('home')->with('success', 'Đăng nhập thành công');
            }

            return redirect()->back()->with('error', 'Đăng nhập thất bại');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đăng nhập thất bại: ' . $e->getMessage());
        }
    }
}
