<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\RatingService;
use Illuminate\Http\Request;
use Validator;

class RatingController extends BaseController
{
    public $service;

    public function __construct(RatingService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('AllrequestAPI', $request->all());
        // $validator = Validator::make($request->all(), [
        //     'content' => 'required|string',
        //     'numberstart' => 'required|integer|min:1|max:5',
        //     'company_id' => 'required|integer',
        //     'user_id' => 'required|integer',
        // ]);

        // if ($validator->fails()) {
        //     return $this->failed('Validation failed', 400, $validator->errors());
        // }


        $result = $this->service->create($request);
        if (!$result['status']) {
            return $this->failed('Create rating failed', 400, $result['errors']);
        }

        return $this->success($result['data'], 'Create rating success', 201);
    }

    public function showRatingByCompanyId($id) {
        try {

            $rating = $this->service->showRatingByCompanyId($id);


            if ($rating->isEmpty()) {
                return $this->failed('Ratings not found', 404);
            }


            return $this->success($rating, 'Ratings retrieved successfully', 200);
        } catch (\Exception $e) {

            return $this->exception(
                'An error occurred while retrieving ratings',
                $e->getMessage(),
                500
            );
        }
    }

    public function checkRating($userId,$company_id)
    {
        return $this->service->checkRating($userId,$company_id);
    }

    public function avgPointCompany($company_id)
    {
        return $this->service->avgPointCompany($company_id);
    }

    public function countAllRating($company_id)
    {
        return $this->service->countAllRating($company_id);
    }

    public function countStarRating($company_id)
    {
        return $this->service->countStarRating($company_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
