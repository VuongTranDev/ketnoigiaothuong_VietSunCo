<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Companies;
use App\Models\CompanyCategory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    public function createCompany123(Request $request)
    {
        $client = new Client();
        $response = $client->post(env('API_URL') . 'createCompany', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'representative' => $request->representative,
                'company_name' => $request->company_name,
                'short_name' => $request->short_name,
                'phone_number' => $request->phone_number,
                'slug' => $request->slug,
                'content' => $request->content,
                'link' => $request->link,
                'user_id' => Session::get('user')->id,
            ]
        ]);
        $data = json_decode($response->getBody());

        if ($data->status == 'success') {
            return redirect()->back()->withSuccess('Công ty đã được tạo thành công');
        } else {
            return redirect()->back()->withErrors($data->errors)->withInput();
        }




    }
}
