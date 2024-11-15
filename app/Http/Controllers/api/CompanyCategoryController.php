<?php

namespace App\Http\Controllers\api;

use App\Models\CompanyCategory;
use App\Services\CompanyCategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CompanyCategoryController extends BaseController
{
    public $companyCategoryService;

    public function __construct(CompanyCategoryService $companyCategoryService)
    {
        $this->companyCategoryService = $companyCategoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $companycategory = $this->companyCategoryService->show($request);

            if ($companycategory->isEmpty()) {
                return $this->failed('Company category not found', 404);
            }

            return $this->success(
                $companycategory->map(fn($category) => $this->companyCategoryService->formatData($category)),
                'Company categories retrieved successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->exception('An error occurred while retrieving company categories', $e->getMessage(), 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = $this->companyCategoryService->validateData($request);

            if ($validator->fails()) {
                return $this->failed($validator->errors(), 422);
            }

            $companyCategory = $this->companyCategoryService->create($request);

            return $this->success(
                $this->companyCategoryService->formatData($companyCategory),
                'Company category created successfully',
                201
            );
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return $this->failed('Duplicate entry detected', 409);
            }
            return $this->exception('Database query error occurred', $e->getMessage(), 500);
        } catch (ValidationException $e) {
            return $this->failed($e->errors(), 422);
        } catch (\Exception $e) {
            return $this->exception('An error occurred while creating the company category', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $companycategory = $this->companyCategoryService->showById($id);

            if (!$companycategory) {
                return $this->failed('Company category not found!', 404);
            }

            return $this->success(
                $this->companyCategoryService->formatData($companycategory),
                'Company category retrieved successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->exception('An error occurred while retrieving the company category', $e->getMessage(), 500);
        }
    }

    public function showCategoryByCompanyId(string $id)
    {
        try {
            $companycategory = $this->companyCategoryService->showCategoryByCompanyId($id);

            if ($companycategory->isEmpty()) {
                return $this->failed('Company category not found!', 404);
            }

            return $this->success(
                $companycategory,
                'Company category retrieved successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->exception('An error occurred while retrieving the company category', $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $this->companyCategoryService->validateData($request);

        if ($validator->fails()) {
            return $this->failed($validator->errors(), 422);
        }

        try {
            $companycategory = $this->companyCategoryService->update($request, $id);

            return $this->success(
                $this->companyCategoryService->formatData($companycategory),
                'Company category updated successfully',
                201
            );
        } catch (ModelNotFoundException $e) {
            return $this->failed('Company category not found', 404);
        } catch (\Exception $e) {
            return $this->exception('An error occurred while updating the company category', $e->getMessage(), 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->companyCategoryService->delete($id);

            return $this->success([],  'Company category deleted successfully', 200);
        } catch (ModelNotFoundException $e) {
            return $this->failed('Company category not found', 404);
        } catch (\Exception $e) {
            return $this->exception('An error occurred while deleting the company category', $e->getMessage(), 500);
        }
    }
}
