<?php

namespace App\Http\Controllers\backend;

use App\DataTables\NewsDatatables;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class NewsController extends Controller
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
        return view('frontend.admin.news.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.admin.news.create');
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
            return redirect()->route('admin.news.index')->with('success', 'Thêm tin tức mới thành công!');
        }
        else {
            return redirect()->route('admin.news.index')->with('error', 'Thêm tin tức mới thất bại!');
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
        return view('frontend.admin.news.edit')->with('new', $new);
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
            return redirect()->route('admin.news.index')->with('success', 'Cập nhật tin tức thành công!');
        }
        else {
            return redirect()->route('admin.news.index')->with('error', 'Cập nhật tin tức thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
