<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Session;

class DashboardController extends Controller
{
    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function index() {

        return view('frontend.admin.dashboard.index');
    }

    public function partner() {
        $user = Session::get('user') ;
        $url = config('api.base_url') . "new/countNewsOfUser/{$user->id}";
        $response= $this->client->request('GET', $url);
        if(!$response)
            return back()->with("error","Lỗi hệ thống") ;
        $totalNews = (json_decode($response->getBody(),false))->data ;

        $url = config('api.base_url') . "report/countUser";
        $response = $this->client->request('GET', $url);
        if(!$response)
            return back()->with("error","Lỗi hệ thống") ;

        $totalUser = (json_decode($response->getBody(),false))->data ;
        return view('frontend.partner.index',compact('totalNews','totalUser'));
    }
}
