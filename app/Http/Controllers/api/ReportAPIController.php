<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Services\ReportServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Log;
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
            return $this->failed("validate error", 400, $validator->getMessageBag());
        $userCount = $this->reportService->statisticNews($request);
        return $this->success($userCount, "Danh sách các bài viết đã tạo trong 1 khoản thời gian", 200);
    }


    public function showNewsHot()
    {
        $userCount = $this->reportService->showNewsHot();
        return $this->success($userCount, "Danh sách các bài viết theo xu hướng", 200);
    }

    public function companiesHot()
    {
        $userCount = DB::select('CALL proc_statisticCongTySoiNoi()');
        return $this->success($userCount, "Danh sách các bài viết theo xu hướng", 200);
    }

    public function countTransactions($user_id)
    {
        $userCount = DB::select('CALL proc_soluongGiaoDich(?)', [$user_id]);
        $data = $userCount[0]->tong;
        return $this->success($data, "Số lượng giao dịch", 200);
    }

    public function countCompaniesConnect($user_id)
    {
        $userCount = DB::select('CALL proc_ketnoiDoanhNghiep(?)', [$user_id]);
        $data = $userCount[0]->tong;
        return $this->success($data, "Số lượng công ty đã kết nối", 200);
    }

    public function countCategoriesOfCompany($user_id)
    {
        $userCount = DB::select('CALL proc_countCategoriesOfCompany(?)', [$user_id]);
        $data = $userCount[0]->tong;
        return $this->success($data, "Tổng số lĩnh vực đang tham gia", 200);
    }

    public function statisticActivity($user_id)
    {
        $userCount = DB::select('CALL proc_statisticActivity(?)', [$user_id]);
        return $this->success($userCount, "Danh sách công ty thân thiết", 200);
    }


}
