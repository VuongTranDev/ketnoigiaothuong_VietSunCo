<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function companyDetail()
    {
        return view('frontend.company.company-detail');
    }

    public function companyList()
    {
        return view('frontend.company.list-company');
    }
}
