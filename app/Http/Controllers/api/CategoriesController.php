<?php

namespace App\Http\Controllers\api;

use App\Models\Categories;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CategoriesController extends BaseController
{
    public $categoryService;

    /**
     * Summary of __construct
     * @param \App\Services\CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = $this->categoryService->show($request);

        if ($category == null) {
            return $this->failed('category not found', 404);
        } else {
            return $this->success($category, 200, 'category retrieved successfully');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->categoryService->validateData($request);

        if ($validator->fails()) {
            return $this->failed($validator->errors(), 422);
        }

        $category = $this->categoryService->create($request);

        return $this->success($category, 201, 'category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $category = $this->categoryService->showById($id);

        if ($category == null) {
            $this->failed('category not found', 404);
        }

        return $this->success($category, 200, 'category retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $this->categoryService->validateData($request);

        if ($validator->fails()) {
            return $this->failed($validator->errors(), 422);
        }
        try {
            $category = $this->categoryService->update($request, $id);
            return $this->success($category, 200, 'category updated successfully');
        } catch (ModelNotFoundException $e) {
            return $this->failed('category not found!', 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->categoryService->delete($id);
            return $this->success([], 200, 'category deleted successfully');
        } catch (ModelNotFoundException $e) {
            return $this->failed('category not found', 404);
        } catch (\Exception $e) {
            return $this->exception('an error occurred', $e->getMessage(), 500);
        }
    }
}
