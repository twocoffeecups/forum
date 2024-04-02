<?php

namespace App\Http\Controllers\Api\Dashboard\ReportReasonTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Report\ReportReasonUpdateRequest;
use App\Models\ReportReasonType;

class UpdateController extends Controller
{
    /**
     * @param ReportReasonUpdateRequest $request
     * @param ReportReasonType $reportReason
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ReportReasonUpdateRequest $request, ReportReasonType $reportReason)
    {
        $data = $request->validated();
        $reportReason->fill($data);
        $reportReason->save();
        return response()->json(['message' => 'Report reason type updated!']);
    }
}
