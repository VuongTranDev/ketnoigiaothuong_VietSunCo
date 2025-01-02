<?php

namespace App\Http\Controllers\partner;

use App\DataTables\NewsDatatables;
use App\Http\Controllers\Controller;
use App\Http\Controllers\frontend\BaseController;
use App\Traits\ImageUploadTrait;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Session;

class NewsController extends BaseController
{
    use ImageUploadTrait;
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
        $url = env('API_URL') . "new";
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
        $data = $request->only(['title', 'tag_name', 'content', 'user_id', 'cate_id']);

        $imagePath = $this->uploadImage($request, 'image', 'frontend/image/news');
        $data['image'] = $imagePath;

        $url = env('API_URL') . "new";
        $response = $this->client->request(
            'POST',
            $url,
            [
                'form_params' => $data
            ]
        );

        if ($response->getStatusCode() == 201) {
            return redirect()->route('partner.news.index')->with('success', 'Thêm tin tức mới thành công!');
        } else {
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
        $url = env('API_URL') . "new/{$id}";

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
        $url = env('API_URL') . "new/{$id}";
        $response = $this->client->request('GET', $url);
        $responseData = json_decode($response->getBody());

        $currentImage = $responseData->data->image;

        $data = $request->only(['id', 'title', 'tag_name', 'content', 'image', 'user_id', 'cate_id']);

        if ($request->hasFile('image')) {
            $imagePath = $this->updateImage($request, 'image', 'frontend/image/news',  $currentImage);
            $data['image'] = $imagePath;
        } else {
            $data['image'] = $currentImage;
        }

        $url = env('API_URL') . "new/{$id}";
        $response = $this->client->request(
            'PUT',
            $url,
            [
                'form_params' => $data
            ]
        );

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
            $url = env('API_URL') . "new/show5NewOfUser/{$user->id}";
            $response = $this->client->request('GET', $url);
            $news = (json_decode($response->getBody(),false))->data ;

            return view('frontend.partner.news.hotnew', compact('news'));
            } catch (RequestException $e) {
            \Log::error('API request failed: ' . $e->getMessage());
            $news = [];
        }
    }

    public function changeStatus(Request $request)
    {
        $url = env('API_URL') . "new/change-status";
        $response = $this->client->request(
            'POST',
            $url,
            [
                'form_params' => [
                    'id' => $request->id,
                    'status' => $request->status
                ]
            ]
        );

        if ($response->getStatusCode() == 200) {
            return response()->json(['message' => 'Cập nhật trạng thái thành công!']);
        } else {
            return response()->json(['message' => 'Cập nhật trạng thái thất bại!']);
        }
    }
}
