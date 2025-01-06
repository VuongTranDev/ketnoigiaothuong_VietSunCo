<?php

namespace App\Services;

use App\Models\News;
use App\Models\Users;
use Carbon\Carbon;
use DB;
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
        $userCount = Users::whereBetween('created_at', [$startDate, $endDate])->get();
        return $userCount;
    }


    public function countUser()
    {
        $usersByMonth = Users::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('count(*) as total')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get();
        return $usersByMonth;
    }

    public function statisticNews(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $startDate = Carbon::parse($start_date)->startOfDay();
        $endDate = Carbon::parse($end_date)->endOfDay();
        $news = News::whereBetween('created_at', [$startDate, $endDate])->get();
        return $news;
    }

    public function showNewsHot()
    {
        return News::withCount('comments')->with('users')
            ->orderBy('comments_count', 'desc')
            ->limit(5)
            ->
            get();
    }




}
