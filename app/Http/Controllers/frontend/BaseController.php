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
        $apiUrl = $this->url . $endpoint;

        $response = $this->client->request('GET', $apiUrl);
        $responseData = json_decode($response->getBody()->getContents(), false);

        if ($responseData->status == 'success') {
            $data = $responseData->data;

            if (is_array($data)) {
                return $data;
            } else {
                return [$data];
            }
        } else {
            return [];
        }
    }

    public function fetchDataSlugFromApi(string $endpoint)
    {
        $apiUrl = $this->url . $endpoint;

        $response = $this->client->request('GET', $apiUrl);
        $responseData = json_decode($response->getBody()->getContents(), false);

        if ($responseData->status == 'success') {
            return $responseData->data;
        } else {
            return [];
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
