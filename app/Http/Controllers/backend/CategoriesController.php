<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
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
        return view('frontend.admin.categories.index');
    }
    public function create()
    {
        return view('frontend.admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $data = $request->only('name');
            $url = config('api.base_url') . "categories";
                $response = $this->client->request(
                    'POST',
                    $url,
                    [
                        'form_params' => $data
                    ]
                );
            if ($response->getStatusCode() == 201) {
                return redirect()->route('admin.categories.index')->with('success', 'Thêm lĩnh vực mới thành công!');
            } else {
                return redirect()->route('admin.categories.index')->with('error', 'Thêm lĩnh vựcc mới thất bại!');
            }
        } catch (Exception $e) {
            Log::info("message" . $e->getMessage());
            return redirect()->route('admin.categories.index')->with('error', 'Thêm lĩnh vựcc mới thất bại!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $url = config('api.base_url') . "categories/{$id}";
        $response = $this->client->request('GET', $url);
        $responseData = json_decode($response->getBody());
        $category = $responseData->data;
        return view('frontend.admin.categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $data = $request->only('name', 'id');
            $url = config('api.base_url') . "categories/{$request->id}";
            $response = $this->client->request(
                'PUT',
                $url,
                [
                    'form_params' => $data
                ]
            );
            if ($response->getStatusCode() == 200) {
                Log::info("Success");
                return redirect()->route('admin.categories.index')->with('success', 'Update lĩnh vực mới thành công!');
            } else {
                return redirect()->route('admin.categories.index')->with('error', 'Update lĩnh vực mới thất bại!');
            }
        } catch (Exception $e) {
            Log::info("message" . $e->getMessage());
            return redirect()->route('admin.categories.index')->with('error', 'Update lĩnh vực mới thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $url = config('api.base_url') . "categories";
    //     $response = $this->client->request(
    //         'DELETE',
    //         $url,
    //         [
    //             'form_params' => $id
    //         ]
    //     );
    //     if($response->getStatusCode()== 200)
    //         return response()->json()->with('success','Delete thành công');
    //     else
    //         return response()->json()->with('error','Delete thất bại');
    // }
}
