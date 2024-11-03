<?php

namespace App\Services;

use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyCategoryService {
    /**
     * Retrieve all company categories with related user data.
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function show($request) {
        return CompanyCategory::with('companies', 'categories')->get();
    }

    /**
     * Retrieve a specific company category by its ID, including related user data.
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function showById($id) {
        return CompanyCategory::with('companies', 'categories')->find($id);
    }

    /**
     * Format company category data for a structured API response.
     * @param CompanyCategory $companycategory
     * @return array
     */
    public function formatData($companycategory) {
        return [
            'id' => $companycategory->id,
            'category' => $companycategory->categories,
            'company' => $companycategory->companies,
            'description' => $companycategory->description,
            'created_at' => $companycategory->created_at,
            'updated_at' => $companycategory->updated_at
        ];
    }

    /**
     * Validate the data for creating or updating a company category.
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    public function validateData($request) {
        return Validator::make($request->all(), [
            'cate_id' => 'required',
            'company_id' => 'required',
            'description' => 'required',
        ]);
    }

    /**
     * Create a new company category record in the database.
     * @param Request $request
     * @return CompanyCategory|\Illuminate\Database\Eloquent\Model
     */
    public function create($request) {
        return CompanyCategory::create($request->only('cate_id', 'company_id', 'description'));
    }

    /**
     * Update an existing company category record in the database by its ID.
     * @param Request $request
     * @param int $id
     * @return CompanyCategory|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function update($request, $id) {
        $companycategory = CompanyCategory::findOrFail($id);
        $companycategory->update($request->only('cate_id', 'company_id', 'description'));
        return $companycategory;
    }

    /**
     * Delete a company category record from the database by its ID.
     * @param int $id
     * @return CompanyCategory
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id) {
        $companycategory = CompanyCategory::findOrFail($id);
        $companycategory->delete();
        return $companycategory;
    }
}
