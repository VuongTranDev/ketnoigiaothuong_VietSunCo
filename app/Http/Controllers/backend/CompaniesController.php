<?php

namespace App\Http\Controllers\backend;

use App\DataTables\CompanyImagesDataTables;
use App\Http\Controllers\backend\BaseController;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class CompaniesController extends BaseController
{
    protected $client;
    protected $url;
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->url = env('API_URL');
    }
    public function index1 ()
    {

        return view('frontend.admin.companies.index');
    }
    public function index()
    {
        $userId = Session::get('user')->id;
        $company = $this->fetchDataFromApi("company/{$userId}");
        return view('frontend.partner.company.index', compact('company'));
    }

    public function companyCategory()
    {
        $userId = Session::get('user')->id;
        $company = $this->fetchDataFromApi("company/{$userId}");
        $companyCategory = collect($this->fetchDataFromApi("category/company/{$company->id}"));
        $categories = $this->fetchDataFromApi("getAllCategory");
        return view('frontend.partner.company.company_category', compact('companyCategory', 'categories'));
    }

    public function createCompanyImages(Request $request)
    {
        $userId = Session::get('user')->id;
        $company = $this->fetchDataFromApi("company/{$userId}");
        $company_id = $company->id;
        $imageCompany = $request->file('image');
        $imagePaths = [];


        if ($imageCompany && is_array($imageCompany)) {
            foreach ($imageCompany as $image) {


                if ($image instanceof \Illuminate\Http\UploadedFile) {


                    $filename = uniqid('company_', true) . '.' . $image->getClientOriginalExtension();


                    $path = $image->move(public_path('uploads'), $filename);


                    $imagePaths[] = 'uploads/' . $filename;
                }
            }
        }


        $client = new Client();
        foreach ($imagePaths as $imagePath) {
            $responseImage = $client->post(env('API_URL') . 'createNewCompanyImage', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'company_id' => $company_id,
                    'image' => $imagePath,
                ]
            ]);


            $imageData = json_decode($responseImage->getBody()->getContents());


            if ($imageData->status != 'success') {
                return redirect()->back()->withErrors($imageData->errors ?? 'Lỗi không xác định')->withInput();
            }
        }


        return redirect()->back()->with('success', 'Thêm các ảnh  thành công!');
    }

    public function destroyCompanyImage(Request $request)
    {
        $id = $request->input('id');
        try {
            $client = new Client();
            $responseCategory = $client->post(env('API_URL') . 'destroyCompanyImage', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'id' => $id,

                ]
            ]);

            $imagesData = json_decode($responseCategory->getBody()->getContents(), true);


            if ($imagesData === 1) {
                return redirect()->back()->with('success', 'Xóa ảnh  thành công!');
            } else {
                return redirect()->back()->withErrors('Xóa ảnh thất bại. Vui lòng thử lại.');
            }
        } catch (\Exception $e) {
            \Log::error('Error occurred while creating CompanyCategory', [
                'message' => $e->getMessage()
            ]);
            return redirect()->back()->withErrors('Đã xảy ra lỗi. Vui lòng thử lại sau.');
        }
    }

    public function companyImages(CompanyImagesDataTables $datatable)
    {
        $userId = Session::get('user')->id;
        $company = $this->fetchDataFromApi("company/{$userId}");
        $company_id = $company->id;
        \Log::info('Company ID:', ['company_id' => $company_id]);
        request()->merge(['company_id' => $company_id]);

        return $datatable->render('frontend.partner.company.company_images', compact('company', 'company_id'));
    }

    public function storeCategoryCompany(Request $request)
    {
        \Log::info('Allrequest', $request->all());
        $userId = Session::get('user')->id;
        $company = $this->fetchDataFromApi("company/{$userId}");
        $company_id = $company->id;
        $cate_id = $request->cate_id;
        try {
            $client = new Client();
            $responseCategory = $client->post(env('API_URL') . 'createCompanyCategory', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'cate_id' => $cate_id,
                    'company_id' => $company_id,
                ]
            ]);

            $categoryData = json_decode($responseCategory->getBody()->getContents(), true);


            if (isset($categoryData['status']) && $categoryData['status'] === "success") {
                return redirect()->back()->with('success', 'Thêm lĩnh vực thành công!');
            } else {
                return redirect()->back()->withErrors('Thêm lĩnh vực thất bại. Vui lòng thử lại.');
            }
        } catch (\Exception $e) {
            \Log::error('Error occurred while creating CompanyCategory', [
                'message' => $e->getMessage()
            ]);
            return redirect()->back()->withErrors('Đã xảy ra lỗi. Vui lòng thử lại sau.');
        }
    }

    public function deleteCategoryCompany(Request $request)
    {
        \Log::info('Allrequest', $request->all());
        $userId = Session::get('user')->id;
        $company = $this->fetchDataFromApi("company/{$userId}");
        $company_id = $company->id;
        $cate_id = $request->cate_id;
        try {
            $client = new Client();
            $responseCategory = $client->post(env('API_URL') . 'deleteCompanyCategory', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'cate_id' => $cate_id,
                    'company_id' => $company_id,
                ]
            ]);

            $categoryData = json_decode($responseCategory->getBody()->getContents(), true);


            if ($categoryData === 1) {
                return redirect()->back()->with('success', 'Xóa lĩnh vực thành công!');
            } else {
                return redirect()->back()->withErrors('Xóa lĩnh vực thất bại. Vui lòng thử lại.');
            }
        } catch (\Exception $e) {
            \Log::error('Error occurred while creating CompanyCategory', [
                'message' => $e->getMessage()
            ]);
            return redirect()->back()->withErrors('Đã xảy ra lỗi. Vui lòng thử lại sau.');
        }
    }

    public function updateCompany(Request $request)
    {
        try {
            $imagePath = '';
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $image = $request->file('image');
                $filename = uniqid('avatar_', true) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $filename);
                $imagePath = 'uploads/' . $filename;

                \Log::info('Image uploaded: ' . $imagePath);
            }
            \Log::info('Allrequest', $request->all());


            $client = new Client();
            $response = $client->put(env('API_URL') . 'updateCompany', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'id' =>  $request->id,
                    'image' => $imagePath,
                    'representative' => $request->representative,
                    'company_name' => $request->company_name,
                    'short_name' => $request->short_name,
                    'phone_number' => $request->phone_number,
                    'slug' => $request->slug,
                    'content' => $request->content,
                    'link' => $request->link,

                    'email' => $request->email,
                    'tax_code' => $request->tax_code,
                ]
            ]);


            $data = json_decode($response->getBody(), true);


            if (isset($data['result']) && $data['result'] === 1) {
                return redirect()->back()->with('success', 'Cập nhật công ty thành công!');
            } else {
                return redirect()->back()->withErrors('Cập nhật công ty thất bại. Vui lòng thử lại.');
            }
        } catch (\Exception $e) {

            return redirect()->back()->withErrors('Đã xảy ra lỗi trong quá trình cập nhật. Vui lòng thử lại.');
        }
    }

    public function detailCompany($id)
    {
        $company = $this->fetchDataFromApi("company/detail/{$id}");
        return view ('frontend.admin.companies.detail',compact('company'));
    }
}
