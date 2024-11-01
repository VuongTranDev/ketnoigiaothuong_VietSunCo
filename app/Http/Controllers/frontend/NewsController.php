<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function news() {
        return view('frontend.news.news');
    }

    public function newsDetail() {
        return view('frontend.news.new-detail');
    }
}
