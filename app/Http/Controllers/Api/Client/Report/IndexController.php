<?php

namespace App\Http\Controllers\Api\Client\Report;

use App\Http\Controllers\Controller;
use App\Models\ReportReasonType;


class IndexController extends Controller
{
    /**
     * All report reason for report form
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        $reportTypes = ReportReasonType::all();
        return response()->json(['reportTypes' => $reportTypes]);
    }
}
