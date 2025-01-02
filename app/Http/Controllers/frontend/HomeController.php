<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\api\Controller;
use App\Models\Contacts;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class HomeController extends BaseController
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
        try {
            $companies = $this->fetchDataFromApi("company?limit=16");
            $news = $this->fetchDataFromApi("new?limit=3");
        } catch (RequestException $e) {
            Log::error('API request failed: ' . $e->getMessage());
            $companies = [];

        }

        return view('index', compact('companies', 'news'));
    }

    public function sendContact(Request $request)
    {
        $data = $request->only(['name', 'email', 'phone', 'message']);

        $url = env('API_URL') . "send-contact";
        $response = $this->client->request(
            'POST',
            $url,
            [
                'form_params' => $data
            ]
        );

        if($response->getStatusCode() == 201) {
            return redirect()->back()->with('success', 'Gửi liên hệ thành công');
        } else {
            return redirect()->back()->with('error', 'Gửi liên hệ thất bại');
        }
    }

    public function about()
    {
        return view('frontend.home.about');
    }
}
