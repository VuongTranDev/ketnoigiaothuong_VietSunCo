<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Companies;
use App\Models\CompanyCategory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompaniesController extends BaseController
{
    protected $client;
    protected $url;
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->url = env('API_URL');
    }
    public function companyDetail($slug)
    {
        $company = $this->fetchDataFromApi("company/slug/{$slug}");

        $address = $this->fetchDataFromApi("address/company/{$company->id}");

        $categories = collect($this->fetchDataFromApi('category/company/' . $company->id));

        return view('frontend.company.company-detail', compact('company', 'address', 'categories'));
    }


    public function companyList()
    {
        try {
            $companies = $this->fetchDataFromApi("company");
        } catch (RequestException $exception) {
            Log::error('API request failed: ' . $exception->getMessage());
            $companies = [];
        }

        return view('frontend.company.list-company', compact('companies'));
    }
}
