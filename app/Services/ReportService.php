<?php

namespace App\Services;

use App\Models\Comments;
use App\Models\News;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class  ReportServices
{
    public function statisticMember( $startDate,$endDate)
    {
        $userCount = Users::whereBetween('created_at', [$startDate, $endDate])->count();
        return $userCount ;

    }
}
