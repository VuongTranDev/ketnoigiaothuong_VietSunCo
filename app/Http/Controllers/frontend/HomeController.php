<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\api\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
