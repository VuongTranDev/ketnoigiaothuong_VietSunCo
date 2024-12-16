<?php

namespace App\Services;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryService {
    /**
     * Retrieve all categories data.
     * @return Categories[]|\Illuminate\Database\Eloquent\Collection
     */
    public function show()
    {
        return Categories::get();
    }

    /**
     * Retrieve categories by its id.
     * @param int $id
     * @return Categories|Categories[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function showById($id)
    {
        return Categories::find($id);
    }

    /**
     * Summary of validateData
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    public function validateData($request) {
        return Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);
    }

    /**
     * Create a new category record in the database.
     * @param Request $request
     * @return Categories|\Illuminate\Database\Eloquent\Model
     */
    public function create($request) {
        return Categories::create($request->only('name', 'slug'));
    }

    /**
     * Update an existing category record in the database by its ID.
     * @param Request $request
     * @param int $id
     * @return Categories|Categories[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function update($request, $id) {
        $category = Categories::findOrFail($id);
        $category->update($request->only('name', 'slug'));
        return $category;
    }

    /**
     * Delete a category record from the database by its ID.
     * @param mixed $id
     * @return Categories
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id) {
        $category = Categories::findOrFail($id);
        $category->delete();
        return $category;
    }


    public function getAllCategory()
    {
        try {
            $categories = Categories::all();
            if ($categories->isEmpty()) {
                return response()->json([], 200);  // Trả về mảng rỗng nếu không có dữ liệu
            }
            return response()->json($categories, 200);  // Trả về danh sách category
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);  // Xử lý lỗi nếu có
        }
    }



    // public function countNewsOfUser($user_id)
    // {
    //     // Thống kê ra 5 bài viết của công ty có nhiều lượt bình luận nhất
    //     return Cate::where('user_id', $user_id)
    //     ->count();
    // }

}


