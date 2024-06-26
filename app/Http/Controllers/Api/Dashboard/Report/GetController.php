<?php

namespace App\Http\Controllers\Api\Dashboard\Report;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Report\ReportResource;
use App\Models\Report;

class GetController extends Controller
{
    /**
     * @param Report $report
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Report $report): \Illuminate\Http\JsonResponse
    {
        return response()->json(['report' => new ReportResource($report)]);
    }
}
