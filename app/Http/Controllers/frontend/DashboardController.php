<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('frontend.admin.dashboard.index');
    }

    public function partner() {
        return view('frontend.partner.index');
    }
}
