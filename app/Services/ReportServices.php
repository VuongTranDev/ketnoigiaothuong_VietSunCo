<?php

namespace App\Services;

use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use User;

class  ReportServices
{
    public function statisticMember(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $startDate = Carbon::parse($start_date)->startOfDay();
        $endDate = Carbon::parse($end_date)->endOfDay();
        $userCount = Users::whereBetween('created_at', [$startDate, $endDate])->count();
        return $userCount;
    }

    public function countUser()
    {
        // Thống kê ra 5 bài viết của công ty có nhiều lượt bình luận nhất
        return Users::count();
    }
}
