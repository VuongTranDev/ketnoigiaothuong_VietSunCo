<?php

namespace App\Services;

use App\Models\Companies;
use App\Models\CompanyImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CompanyImageService {

    public function createCompanyImage(Request $request)
    {
        \Log::info('Request Data Image:', $request->all());


        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'company_id' => 'required',
        ]);


        if ($validator->fails()) {
            \Log::error('Validation Errors:', $validator->errors()->toArray());
            return [
                'status' => false,
                'errors' => $validator->errors()
            ];
        }


        $companyImage = new CompanyImage();
        $companyImage->image=$request->image;
        $companyImage->company_id=$request->company_id;
        $companyImage->save();
        return [
            'status' => true,
            'data' => $companyImage
        ];
    }

    public function destroyCompanyImage(Request $request)
    {
        try {

            $companyImage = CompanyImage::find($request->id);


            if (!$companyImage) {
                return 0;
            }


            $companyImage->delete();


            return 1;
        } catch (\Exception $e) {

            return 0;
        }
    }
}
