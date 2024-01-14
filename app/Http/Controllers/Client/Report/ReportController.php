<?php

namespace App\Http\Controllers\Client\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Report\ReportRequest;
use App\Models\Post;
use App\Models\ReportReasonType;
use App\Models\Topic;


class ReportController extends Controller
{

    public function __invoke()
    {
        $reportTypes = ReportReasonType::all();
        return response()->json(['reportTypes' => $reportTypes]);
    }

}
