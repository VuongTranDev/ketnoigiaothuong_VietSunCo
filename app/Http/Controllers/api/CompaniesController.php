<?php

namespace App\Http\Controllers\api;

use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;


class CompaniesController extends BaseController
{
    protected $companyService;


    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $limit = $request->input('limit', 12);
            $page = $request->input('page', 1);
            $companies = $this->companyService->show($page, $limit);
            $formattedData = collect($companies->items())->map(function ($item) {
                return $this->companyService->formatData($item);
            })->toArray();
            $formattedPagination = $this->companyService->formatPaginate($companies);

            return $this->successWithPagination(
                $formattedPagination,
                $formattedData,
                200,
            );
        } catch (ModelNotFoundException $e) {
            return $this->failed('Companies not found', 404);
        } catch (\Exception $e) {
            return $this->exception('An error occurred while retrieving companies', $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->companyService->validateData($request);

        if ($validator->fails()) {
            return $this->failed($validator->errors(), 422);
        }

        $company = $this->companyService->create($request);

        return $this->success(
            $this->companyService->formatData($company),
            'company created successfully',
            201
        );
    }


    public function createCompany(Request $request)
    {
        $result = $this->companyService->store($request);
        if (!$result['status']) {
            return $this->failed('Create company failed', 400, $result['errors']);
        }
        return $this->success($result['data'], 'Create company success', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Lấy thằng company id
        // $company = $this->companyService->showById($id);
        //Lấy từ user_id này sửa sau nha đuối quá rồi
        $company = $this->companyService->showByUserId($id);
        if (!$company) {
            return $this->failed('company not found!', 404);
        }

        return $this->success(
            $company,
            'company retrieved successfully',
            200
        );
    }

    public function showBySlug($slug)
    {
        $company = $this->companyService->showBySlug($slug);

        if (!$company) {
            return $this->failed('company not found!', 404);
        }

        return $this->success(
            $this->companyService->formatData($company),
            'company retrieved successfully',
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $this->companyService->validateData($request);

        if ($validator->fails()) {
            return $this->failed('validation failed', 422);
        }

        try {
            $company = $this->companyService->update($request, $id);

            return $this->success(
                $this->companyService->formatData($company),
                'company updated successfully',
                200
            );
        } catch (ModelNotFoundException $e) {
            return $this->failed('company not found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->companyService->delete($id);

            return $this->success([], 'company deleted successfully', 200);
        } catch (ModelNotFoundException $e) {
            return $this->failed('company not found', 404);
        } catch (\Exception $e) {
            return $this->exception('an error occurred', $e->getMessage(), 500);
        }
    }

    public function checkCompanyByUserId(string $id)
    {
        $check=$this->companyService->checkCompanyById($id);
        return $check;
    }

    public function checkCompanyStatus($user_id)
    {
        $status=$this->companyService->checkCompanyStatus($user_id);
        return $status;
    }

    public function checkCompanyByUserIdWithStatus(string $id)
    {
        $check=$this->companyService->checkCompanyByIdWithStatus($id);
        return $check;
    }

    public function findCompanyByName(string $slug)
    {
        $company=$this->companyService->showAllLikeSlug($slug);
        return $company;
    }

    public function findCompanyByCateId(int $cateId)
    {
        $companies=$this->companyService->getCompaniesByCategory($cateId);
        return $companies;
    }

    public function updateCompany(Request $request)
    {
        try {

            \Log::info('AllrequestAPI', $request->all());


            $result = $this->companyService->updateCompany($request);

            return response()->json(['result' => $result]);
        } catch (\Exception $e) {

            return response()->json(['result' => 0, 'error' => 'Đã xảy ra lỗi trong quá trình cập nhật. Vui lòng thử lại.']);
        }
    }

    public function updatePointCompany($company_id,$point)
    {
        try {

            $updatedCompany = $this->companyService->updatePointCompany($company_id, $point);

            if (!$updatedCompany) {
                return $this->failed('company not found or update failed', 404);
            }

            return $this->success(

                'company point updated successfully',
                200
            );
        } catch (ModelNotFoundException $e) {
            return $this->failed('company not found', 404);
        } catch (\Exception $e) {
            return $this->exception('an error occurred while updating company point', $e->getMessage(), 500);
        }
    }
}
