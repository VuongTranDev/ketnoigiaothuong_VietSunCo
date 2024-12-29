<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Services\ReportServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use User;
use Validator;

class ReportAPIController extends BaseController
{
    public $reportService;
    public function __construct(ReportServices $reportService)
    {
        $this->reportService = $reportService;
    }
    public function __invoke(Request $request)
    {

    }
    public function statisticMember(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'start_date' => 'required',
                'end_date' => 'required'
            ]
        );
        if ($validator->fails())
            return $this->failed("validate error", 422, $validator);
        $userCount = $this->reportService->statisticMember($request);
        // Trả về kết quả dưới dạng JSON
        return $this->success($userCount, "Danh sách các tải khoản đã tạo trong 1 khoản thời gian", 200);
    }

    public function countUser()
    {
        $data = $this->reportService->countUser();
        \Log::info("data". json_encode($data)) ;
        return $this->success($data,"Số lượng người dùng",200);
    }
    public function statisticNews(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'start_date' => 'required',
                'end_date' => 'required'
            ]
        );
        if ($validator->fails())
            return $this->failed("validate error", 422, $validator);
        $userCount = $this->reportService->statisticNews($request);
        // Trả về kết quả dưới dạng JSON
        return $this->success($userCount, "Danh sách các bài viết đã tạo trong 1 khoản thời gian", 200);
    }
}
