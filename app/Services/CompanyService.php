<?php

namespace App\Services;

use App\Models\Companies;
use Illuminate\Support\Facades\Auth;
use Faker\Provider\ar_EG\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyService
{
    /**
     * Retrieve all companies with related user data.
     *
     * @param Request $request
     * @return
     */
    public function show($page, $limit)
    {
        return Companies::with('user')->paginate($limit, ['*'], 'page', $page);
    }

    // Tạo mới công ty
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'representative' => 'required|string|max:255',
            'company_name' => 'required|string|max:255|unique:companies,company_name',
            'short_name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:20',
            'slug' => 'required|string|max:100|unique:companies,slug',
            'content' => 'nullable|string',
            'link' => 'nullable|url',
            'user_id' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            \Log::error('Validation Errors:', $validator->errors()->toArray());
            return [
                'status' => false,
                'errors' => $validator->errors()
            ];
        }
        $company = new Companies();
        $company->representative = $request->representative;
        $company->company_name = $request->company_name;
        $company->short_name = $request->short_name;
        $company->phone_number = $request->phone_number;
        $company->slug = $request->slug;
        $company->content = $request->content;
        $company->link = $request->link;
        $company->email = $request->email;
        $company->tax_code = $request->tax_code;
        $company->status = $request->status;
        $company->point = $request->point;
        $company->image = $request->image;
        $company->user_id = $request->user_id;
        $company->save();

        return [
            'status' => true,
            'data' => $company
        ];
    }



    /**
     * Retrieve a specific company by its ID, including related user data.
     *
     * @param int $id
     * @return Companies|null
     */
    public function showById($id)
    {
        return Companies::with('user','companyCategory.categories','addresses')->find($id);
    }


    public function showByUserId($user_id)
    {
        return Companies::with('user')
                        ->where('user_id', $user_id)
                        ->orderBy('created_at', 'desc')
                        ->first();
    }

    public function showAllLikeSlug($slug)
    {
        return Companies::with('user')
            ->where('slug', 'LIKE', '%' . $slug . '%')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    // public function getCompaniesByCategory($categoryId)
    // {
    //     return Companies::whereHas('companyCategory', function ($query) use ($categoryId) {
    //         $query->where('cate_id', $categoryId);
    //     })->get();
    // }

    public function getCompaniesByCategory($categoryId)
    {
        return Companies::with(['companyCategory.categories']) // Load mối quan hệ companyCategory và categories
            ->whereHas('companyCategory', function ($query) use ($categoryId) {
                $query->where('cate_id', $categoryId);
            })
            ->get()
            ->map(function ($company) {
                $categories = $company->companyCategory->map(function ($companyCategory) {
                    return $companyCategory->categories->name; // Lấy tên của từng category
                });
                $company->setAttribute('category_names', $categories); // Gắn danh sách tên categories vào thuộc tính tạm thời
                return $company;
            });
    }

    public function showBySlug($slug)
    {
        $company = Companies::with(['user', 'companyCategory.categories']) // Load user và các categories liên quan
            ->where('slug', $slug)
            ->first();

        if ($company) {
            $categories = $company->companyCategory->map(function ($companyCategory) {
                return $companyCategory->categories->name; // Lấy tên của từng category
            });
            $company->setAttribute('category_names', $categories); // Gắn danh sách tên categories vào thuộc tính tạm thời
        }

        return $company;
    }





    // public function showBySlug($slug)
    // {
    //     return Companies::with('user')->where('slug', $slug)->first();
    // }


    /**
     * Format company data for a structured API response.
     *
     * @param Companies $companies
     * @return array
     */
    public function formatData($companies)
    {
        return [
            'id' => $companies->id,
            'representative' => $companies->representative,
            'company_name' => $companies->company_name,
            'short_name' => $companies->short_name,
            'phone_number' => $companies->phone_number,
            'slug' => $companies->slug,
            'content' => $companies->content,
            'link' => $companies->link,
            'status' => $companies->status,
            'email' =>$companies->email,
            'tax_code' => $companies->tax_code,
            'image' => $companies->image,
            'user' => $companies->user,
            'created_at' => $companies->created_at,
            'updated_at' => $companies->updated_at
        ];
    }

    /**
     * Format pagination data for a structured API response.
     *
     * @param mixed $company
     * @return array
     */
    public function formatPaginate($company)
    {
        return [
            'current_page' => $company->currentPage(),
            'total_page' => $company->lastPage(),
            'total_items' => $company->total(),
            'items_per_page' => $company->perPage()
        ];
    }

    /**
     * Validate the data for creating or updating a company.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($request)
    {
        return Validator::make($request->all(), [
            'representative' => 'required|string|max:255',
            'company_name' => 'required|string|max:255|unique:companies,company_name',
            'short_name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:20',
            'slug' => 'required|string|max:100|unique:companies,slug',
            'content' => 'nullable|string',
            'link' => 'nullable|url',
            'user_id' => 'required|exists:users,id',
        ]);
    }

    /**
     * Create a new company record in the database.
     *
     * @param Request $request
     * @return Companies
     */
    public function create($request)
    {
        return Companies::create(
            $request->only('representative', 'company_name', 'short_name', 'phone_number', 'slug','status','email','masothue', 'content', 'link', 'user_id')
        );
    }

    /**
     * Update an existing company record in the database by its ID.
     *
     * @param Request $request
     * @param int $id
     * @return Companies
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update($request, $id)
    {
        $company = Companies::findOrFail($id);
        $company->update($request->only('representative', 'company_name', 'short_name', 'phone_number', 'slug', 'content', 'link'));
        return $company;
    }

    /**
     * Delete a company record from the database by its ID.
     *
     * @param int $id
     * @return Companies
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id)
    {
        $companies = Companies::findOrFail($id);
        $companies->delete();
        return $companies;
    }

    public function updateCompany(Request $request)
    {
        try {
            \Log::info('AllrequestAPITT', $request->all());
            $company = Companies::findOrFail($request->id);

            $data = $request->only('image', 'representative', 'company_name', 'short_name', 'phone_number', 'email', 'tax_code', 'content', 'link');
            $slugs = \Str::slug($request->company_name);
            $data['slug'] = $slugs;
            // Cập nhật công ty
            $updated = $company->update($data);

            // Trả về kết quả
            return $updated ? 1 : 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function checkCompanyByIdWithStatus($user_id)
    {
        $company = Companies::with('user')
            ->where('user_id', $user_id)
            ->where('status', '!=', 0)
            ->orderBy('created_at', 'desc')
            ->first();

        return $company ? 1 : 0;
    }

    public function checkCompanyStatus($user_id)
    {
        $company = Companies::with('user')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->first();


        if (!$company) {
            return 2;
        }


        return $company->status != 0 ? 1 : 0;
    }

    public function checkCompanyById($user_id)
    {
        $company = Companies::with('user')
                ->where('user_id', $user_id)
                ->orderBy('created_at', 'desc')
                ->first();  // Lấy bản ghi đầu tiên
        return $company ? 1 : 0;
    }

    public function updatePointCompany($company_id, $point)
    {
        $company = Companies::find($company_id);


        if (!$company) {
            return [
                'status' => false,
                'message' => 'Company not found',
            ];
        }


        $company->point = $point;


        $company->save();

        return [
            'status' => true,
            'message' => 'Point updated successfully',
            'data' => $company,
        ];
    }
    public function changeStatus(Request $request,$id)
    {
        $company = Companies::findOrFail($id);
        $company->status = $request->status;
        $company->save() ;
        return $company;
    }
}
