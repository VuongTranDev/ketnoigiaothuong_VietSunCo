<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function news() {
        return view('frontend.news.news');
    }

    public function newsDetail() {
        return view('frontend.news.new-detail');
    }

    public function showData() {
        $client = new Client();
        $respone = $client->request('GET', 'http://127.0.0.1:8000/api/new');
        return view('frontend.news.show-data');
    }
}
