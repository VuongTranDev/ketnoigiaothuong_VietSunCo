<?php

namespace App\Http\Controllers\api;

use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = $this->companyService->showById($id);

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
}
