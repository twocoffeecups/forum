<?php

namespace App\Http\Controllers\Api\Dashboard\ReportReasonTypes;

use App\Http\Controllers\Controller;
use App\Models\ReportReasonType;

class DeleteController extends Controller
{
    /**
     * @param ReportReasonType $reportReason
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ReportReasonType $reportReason)
    {
        if(count($reportReason->reports)!==0){
            return response()->json(['message' => 'Deletion is not possible! There are reports about this.'], 413);
        }
        $reportReason->delete();
        return response()->json(['message' => 'Report reason type deleted successfully!']);
    }
}
