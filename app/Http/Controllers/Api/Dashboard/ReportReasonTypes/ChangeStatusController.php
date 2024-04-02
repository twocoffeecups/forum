<?php

namespace App\Http\Controllers\Api\Dashboard\ReportReasonTypes;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Report\ReportReasonResource;
use App\Models\ReportReasonType;

class ChangeStatusController extends Controller
{
    /**
     * Change report reason status
     * @param ReportReasonType $reportReason
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ReportReasonType $reportReason)
    {
        $reportReason->status = !$reportReason->status;
        $reportReason->save();
        return response()->json(['message' => 'Report reason type status changed']);
    }
}
