<?php

namespace App\Http\Controllers\partner;

use App\DataTables\NewsDatatables;
use App\Http\Controllers\Controller;
use App\Http\Controllers\frontend\BaseController;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Session;

class NewsController extends BaseController
{
    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = config('api.base_url') . "new";
        $response = $this->client->request('GET', $url);
        $data = json_decode($response->getBody());
        return view('frontend.partner.news.index')->with('data', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.partner.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['title', 'tag_name', 'content']);
        $data['cate_id'] = 1;
        $data['user_id'] = 1;
        $url = config('api.base_url') . "new";
        $response = $this->client->request('POST', $url, [
            'form_params' => $data
        ]);

        if($response->getStatusCode() == 201) {
            return redirect()->route('partner.news.index')->with('success', 'Thêm tin tức mới thành công!');
        }
        else {
            return redirect()->route('partner.news.index')->with('error', 'Thêm tin tức mới thất bại!');
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $url = config('api.base_url') . "new/{$id}";

        $response = $this->client->request('GET', $url);

        $responseData = json_decode($response->getBody());
        $new = $responseData->data;
        return view('frontend.partner.news.edit')->with('new', $new);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['title', 'tag_name', 'content']);
        $data['cate_id'] = 1;
        $data['user_id'] = 1;

        $url = config('api.base_url') . "new/{$id}";
        $response = $this->client->request('PUT', $url, [
            'form_params' => $data
        ]);

        if($response->getStatusCode() == 200) {
            return redirect()->route('partner.news.index')->with('success', 'Cập nhật tin tức thành công!');
        }
        else {
            return redirect()->route('partner.news.index')->with('error', 'Cập nhật tin tức thất bại!');
        }
    }
    public function destroy(string $id)
    {
        //
    }

    public function hotNews()
    {
        try {
            //
            $user = Session::get('user') ;
            $url = config('api.base_url') . "new/show5NewOfUser/{$user->id}";
            $response = $this->client->request('GET', $url);
            $news = (json_decode($response->getBody(),false))->data ;

            return view('frontend.partner.news.hotnew', compact('news'));
            } catch (RequestException $e) {
            \Log::error('API request failed: ' . $e->getMessage());
            $news = [];
        }
    }


}