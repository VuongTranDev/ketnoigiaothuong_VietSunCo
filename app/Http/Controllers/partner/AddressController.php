<?php

namespace App\Http\Controllers\partner;

use App\Http\Controllers\Controller;
use App\Models\Provinces;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AddressController extends Controller
{
    protected $client;
    protected $url;
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->url = env('API_URL');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.partner.address.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Provinces::all();
        return view('frontend.partner.address.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $response = $this->client->request('POST', $this->url . 'address', [
                'form_params' => [
                    'company_id' => $request->user_id,
                    'details' => $request->details,
                    'address' => $request->address,
                ]
            ]);
            $data = json_decode($response->getBody()->getContents());
            if ($data->status == 'error') {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Tạo địa chỉ thất bại',
                    ]
                );
            }
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Tạo địa chỉ thành công',
                ]
            );
        } catch (\Exception $e) {
            \Log::error('Unexpected error: ' . $e->getMessage());
            return redirect()->back()->withErrors('Đã xảy ra lỗi. Vui lòng thử lại sau.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
