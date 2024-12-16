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

}
