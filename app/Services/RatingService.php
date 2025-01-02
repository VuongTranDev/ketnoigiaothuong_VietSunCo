<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingService {

    public function create($request)
    {
        try {
            $rating = Ratings::create($request->only('content', 'numberstart', 'company_id', 'user_id'));

            return [
                'status' => true,
                'data' => $rating,
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }

    public function showRatingByCompanyId($id)
    {
        // return Ratings::where('company_id', $id)
        //     ->orderBy('created_at', 'desc')
        //     ->get();
       return  Ratings::with('user.company')
                ->where('company_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
    }

    public function checkRating($userId,$company_id)
    {
        $exists = Ratings::where('user_id', $userId)
        ->where('company_id', $company_id)
        ->exists();

         return $exists ? 1 : 0;
    }

    public function avgPointCompany($company_id)
    {
        $average = Ratings::where('company_id', $company_id)
             ->avg('numberstart');

             return $average ?: 0;
    }

    public function countAllRating($company_id)
    {
        return Ratings::where('company_id', $company_id)->count();
    }

    public function countStarRating($company_id)
    {
        $starRatings = [];


        for ($star = 1; $star <= 5; $star++) {

            $count = Ratings::where('company_id', $company_id)
                ->where('numberstart', $star)
                ->count();


            $starRatings[$star] = $count;
        }

      
        return $starRatings;
    }

    public function formatData($rating)
    {
        if (!$rating) {
            return null;
        }

        return [
            'id' => $rating->id,
            'content' => $rating->content,
            'numberstart' => $rating->numberstart,
            'company_id' => $rating->company_id,
            'user_id' => $rating->user_id,
            'created_at' => $rating->created_at
        ];
    }
}
