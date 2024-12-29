<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\frontend\BaseController;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CompaniesController extends BaseController
{
    protected $client;
    protected $url;
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->url = env('API_URL');
    }
    public function index ()
    {

        return view('frontend.admin.companies.index');
    }

    public function detailCompany($id)
    {
        $company = $this->fetchDataFromApi("company/detail/{$id}");
        return view ('frontend.admin.companies.detail',compact('company'));
    }
}
