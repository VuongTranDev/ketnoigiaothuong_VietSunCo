<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BaseController extends Controller
{
    protected $client;
    protected $url;
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->url = env('API_URL');
    }
    public function fetchDataFromApi(string $endpoint)
    {
        try {
            $apiUrl = $this->url . $endpoint;
            $response = $this->client->request('GET', $apiUrl);
            $responseData = json_decode($response->getBody()->getContents(), false);

            if (!isset($responseData->status)) {
                return $responseData;
            }

            if ($responseData->status == 'success') {
                return $responseData->data;
            } else {
                return [];
            }
        } catch (\Exception $e) {
            Log::error('API request failed: ' . $e->getMessage());
            return [];
        }
    }

    public function sendDataToApi(string $endpoint)
    {
        try {
            $apiUrl = $this->url . $endpoint;
            $response = $this->client->request('PUT', $apiUrl);
            $responseData = json_decode($response->getBody()->getContents(), false);

            if (!isset($responseData->status)) {
                return $responseData;
            }

            if ($responseData->status === 'success') {
                return $responseData->data;
            } else {
                return [];
            }
        } catch (\Exception $e) {
            Log::error('API request failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Make an API request.
     *
     * @param $method
     * @param $endpoint
     * @param $data
     * @return mixed
     */
    protected function makeApiRequest($method, $endpoint, $data = [])
    {
        try {
            $response = $this->client->request($method, $this->url . $endpoint, [
                'form_params' => $data
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            Log::error('API request failed: ' . $e->getMessage());
            return null;
        }
    }
}
