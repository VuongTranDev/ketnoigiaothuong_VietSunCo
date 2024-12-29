<?php

namespace App\Http\Controllers\api;

use App\Models\Categories;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
    public function index()
    {
        $category = $this->categoryService->show();
        if ($category == null) {
            return $this->failed('category not found', 404);
        } else {
            return $this->success($category,  'category retrieved successfully', 200);
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
        return $this->success($category,  'category created successfully', 201);
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
        return $this->success($category, 'category retrieved successfully', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = $this->categoryService->validateData($request);
        if ($validator->fails()) {
            return $this->failed($validator->errors(), 422);
        }
        try {
            $category = $this->categoryService->update($request);
            return $this->success($category,  'category updated successfully', 200);
        } catch (ModelNotFoundException $e) {
            Log::info("message".$e->getMessage());
            return $this->failed('category not found!', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->categoryService->delete($id);
            return $this->success([],  'category deleted successfully', 200);
        } catch (ModelNotFoundException $e) {
            return $this->failed('category not found', 404);
        } catch (\Exception $e) {
            return $this->exception('an error occurred', $e->getMessage(), 500);
        }
    }


    // Trong controller của Điền
    public function getAllCategory()
    {
        try {
            // Giả sử $categories là kết quả từ phương thức getAllCategory
            $categories = $this->categoryService->getAllCategory();

            // Kiểm tra nếu categories là một collection hoặc kiểu dữ liệu có chứa phần "original"
            if (isset($categories->original)) {
                $categories = $categories->original; // Truy cập vào phần dữ liệu thực tế
            }

            if (empty($categories)) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No categories found',
                    'data' => [],
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Category retrieved successfully',
                'data' => $categories,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'data' => [],
                'exception' => $e->getMessage(),
            ], 500);
        }
    }

}
