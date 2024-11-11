<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\api\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            $apiUrl = $this->url . "company";
            $response = $this->client->request('GET', $apiUrl);
            $data = json_decode($response->getBody()->getContents());

            $companies = $data->data ?? [];
        } catch (RequestException $e) {
            Log::error('API request failed: ' . $e->getMessage());
            $companies = [];
        }

        return view('index')->with('companies', $companies);
    }
}
