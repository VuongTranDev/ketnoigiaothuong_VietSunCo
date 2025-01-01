<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Session;

class DashboardController extends Controller
{
    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function index()
    {

        return view('frontend.admin.dashboard.index');
    }

    private function fetchApiData($endpoint, $errorMessage)
    {
        try {
            $response = $this->client->request('GET', $endpoint);
            return json_decode($response->getBody(), false)->data ?? null;
        } catch (\Exception $e) {
            report($e);
            return back()->with("error", $errorMessage);
        }
    }

    public function partner()
    {
        $user = Session::get('user');
        $baseUrl = env('API_URL');
        $endpoints = [
            'totalNews' => "new/countNewsOfUser/{$user->id}",
            'totalUser' => "report/countUser",
            'totalTransaction' => "report/countTransactions/{$user->id}",
            'totalConnect' => "report/countCompaniesConnect/{$user->id}",
            'totalCategories' => "report/countCategoriesOfCompany/{$user->id}",
        ];
        $data = [];
        foreach ($endpoints as $key => $endpoint) {
            $data[$key] = $this->fetchApiData("{$baseUrl}{$endpoint}", "Lỗi khi lấy dữ liệu từ {$key}");
        }
        return view('frontend.partner.index', $data);
    }
}
