<?php

namespace App\Http\Controllers\Api\Dashboard\ReportReasonTypes;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Report\ReportReasonResource;
use App\Models\ReportReasonType;

class GetFormResourceController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        $reportReasons = ReportReasonType::all()->where('status', '=', 1);
        return response()->json(['reportReasonTypes' => ReportReasonResource::collection($reportReasons)]);
    }
}
