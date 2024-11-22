<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\ClientException;

class DashboardController extends Controller
{
    public function index()
    {
        return view('frontend.admin.dashboard.index');
    }
}
