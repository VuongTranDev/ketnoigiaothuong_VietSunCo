<?php

namespace App\Services;

use App\Models\Companies;
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

    /**
     * Retrieve a specific company by its ID, including related user data.
     *
     * @param int $id
     * @return Companies|null
     */
    public function showById($id)
    {
        return Companies::with('user')->find($id);
    }

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
    public function formatPaginate($company) {
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
            $request->only('representative', 'company_name', 'short_name', 'phone_number', 'slug', 'content', 'link', 'user_id')
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
        $companies = Companies::findOrFail($id);
        $companies->update($request->only('representative', 'company_name', 'short_name', 'phone_number', 'slug', 'content', 'link'));
        return $companies;
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
}