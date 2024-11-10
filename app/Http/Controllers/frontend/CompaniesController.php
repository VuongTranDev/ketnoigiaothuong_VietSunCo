<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompaniesController extends BaseController
{
    public function companyDetail()
    {
        return view('frontend.company.company-detail');
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
