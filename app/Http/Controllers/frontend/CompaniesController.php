<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Companies;
use App\Models\CompanyCategory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CompaniesController extends BaseController
{
    protected $client;
    protected $url;
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->url = env('API_URL');
    }

    public function checkCompanyStatus()
    {
        $userId = Session::get('user')->id;
        $company = $this->fetchDataFromApi("company/{$userId}");
        $status=$this->fetchDataFromApi("checkCompanyStatus/{$userId}");
        if($status===0)
        {
            return redirect()->back()->with('success', 'Tài khoản đã đăng ký công ty và đang được chờ để xét duyệt !');
        }
        else if($status===1)
        {
            return redirect()->back()->with('success', 'Tài khoản đã đăng ký công ty và đang hoạt động !');
        }
        else
        {
            return redirect()->back()->with('error', 'Tài khoản chưa đăng ký, xin vui lòng đăng ký thành viên ở góc trên bên phải trang web !');
        }
    }


    public function companyDetail($slug)
    {

        $company = $this->fetchDataFromApi("company/slug/{$slug}");


        if (is_object($company)) {

            $address = $this->fetchDataFromApi("address/company/{$company->id}");


            $categories = collect($this->fetchDataFromApi("category/company/{$company->id}"));

            $ratings=  $this->fetchDataFromApi("ratings/company/{$company->id}");

            $companyPoint=$this->fetchDataFromApi("avgPointCompany/{$company->id}");
            $starRating=$this->fetchDataFromApi("countStarRating/{$company->id}");
            $allRating=$this->fetchDataFromApi("countAllRating/{$company->id}");
            $news = $this->fetchDataFromApi("new/company/{$company->id}?limit=4");
            $this->sendDataToApi("updatePointCompany/{$company->id}/{$companyPoint}");
            if (!Session::has('user') || Session::get('user') === null) {
                return view('frontend.company.company-detail', compact('news','companyPoint','starRating','allRating','ratings','company', 'address', 'categories'));
            }
            $userId=Session::get('user')->id;
            $checkRating= $this->fetchDataFromApi("checkRating/$userId/{$company->id}");
            return view('frontend.company.company-detail', compact('news','companyPoint','starRating','allRating','userId','checkRating','ratings','company', 'address', 'categories'));

        }


        return redirect()->route('company.not-found');
    }


    public function companyList(Request $request)
    {
        $currentPage = $request->input('page', 1);
        $limit = 15;

        try {
            $url = env('API_URL') . "company?limit={$limit}&page={$currentPage}";
            $response = $this->client->request('GET', $url);
            $companysResponse = json_decode($response->getBody());

            $companies = $companysResponse->data;
            $paginate = $companysResponse->paginate;
        } catch (RequestException $exception) {
            Log::error('API request failed: ' . $exception->getMessage());
            $companies = [];
        }
        return view('frontend.company.list-company', compact('companies', 'paginate'));
    }

    public function findCompany(Request $request)
    {
        $slug=\Str::slug($request->name);
        $client = new Client();
        $responseCompany = $client->get(env('API_URL') . 'getAllCompany/'  . $slug);
        $companiesData = json_decode($responseCompany->getBody()->getContents());
        return view('frontend.company.list-find-companies',compact('companiesData'));
    }

    public function findCompanyByCate(int $cateId)
    {

        $client = new Client();
        $responseCompany = $client->get(env('API_URL') . 'getCompanyByCate/'  . $cateId);
        $companiesData = json_decode($responseCompany->getBody()->getContents());
        return view('frontend.company.list-find-companies',compact('companiesData'));
    }

    public function createCompany(Request $request)
    {
        Log::info('Allrequest', $request->all());
        if (!Session::has('user') || Session::get('user') === null) {
            return redirect()->route('auth.login')->withErrors('Vui lòng đăng nhập để tạo công ty');
        }
        // Tạo slug từ tên công ty
        $slug = \Str::slug($request->company_name);
        $userId=Session::get('user')->id;

        $avatar = $request->company_avatar;
        $avatarPath = null;

        if ($avatar && $avatar instanceof \Illuminate\Http\UploadedFile) {
            $filename = uniqid('avatar_', true) . '.' . $avatar->getClientOriginalExtension();

            // Lưu file vào thư mục 'uploads'
            $path = $avatar->move(public_path('uploads'), $filename);

            // Lưu đường dẫn để sử dụng sau
            $avatarPath = 'uploads/' . $filename;
        }

        $client = new Client();
        $response = $client->post(env('API_URL') . 'createCompany', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'representative' => $request->representative,
                'company_name' => $request->company_name,
                'short_name' => $request->short_name,
                'phone_number' => $request->phone_number,
                'point' => 0,
                'slug' => $slug,
                'content' => $request->content,
                'link' => $request->link,
                'user_id' => $userId,
                'image' =>$avatarPath,
                'email' => $request->email,
                'status' => 0,
                'tax_code' => $request->tax_code,
            ]
        ]);

        $data = json_decode($response->getBody());

        // Dùng để lấy id của company vừa tạo
        $clientCompanyId = new Client();
        $responseCompanyId = $clientCompanyId->get(env('API_URL') . 'company/'  . $userId);
        $companyDataByUser = json_decode($responseCompanyId->getBody()->getContents());
        $company_id=$companyDataByUser->data->id;

        $categoryIds = $request->input('category_id');
        $categoryIds = json_decode($categoryIds[0], true);
        Log::info('category',$categoryIds);
        foreach ($categoryIds as $categoryId) {
            // Kiểm tra nếu $categoryId là chuỗi JSON và giải mã nó
            $categoryId = json_decode($categoryId);

            // Kiểm tra xem $categoryId có phải là mảng không, nếu là mảng thì lấy phần tử đầu tiên
            if (is_array($categoryId)) {
                $categoryId = $categoryId[0];  // Lấy phần tử đầu tiên nếu nó là mảng
            }

            $client = new Client();
            $responseCategory = $client->post(env('API_URL') . 'createCompanyCategory', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'cate_id' => $categoryId,  // Gửi category_id
                    'company_id' => $company_id,  // Gửi company_id
                ]
            ]);

            $categoryData = json_decode($responseCategory->getBody()->getContents());

            // Kiểm tra kết quả trả về từ API
            if ($categoryData->status != 'success') {
                return redirect()->back()->withErrors($categoryData->errors ?? 'Lỗi không xác định')->withInput();
            }
        }

         // Lưu ảnh vào thư mục uploads
        $imageCompany = $request->company_images;
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

        // Gửi các tên ảnh đã thay đổi đến API
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

            // Kiểm tra kết quả trả về từ API
            if ($imageData->status != 'success') {
                return redirect()->back()->withErrors($imageData->errors ?? 'Lỗi không xác định')->withInput();
            }
        }

        if ($data->status == 'success') {
            return redirect()->back()->withSuccess('Công ty đã được tạo thành công');
        } else {
            return redirect()->back()->withErrors($data->errors)->withInput();
        }

    }







}
