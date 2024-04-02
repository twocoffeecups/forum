<?php

namespace App\Http\Controllers\Api\Dashboard\ReportReasonTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Requests\Dashboard\Report\ReportReasonStoreRequest;
use App\Http\Requests\Dashboard\Report\ReportReasonUpdateRequest;
use App\Http\Resources\Dashboard\Report\ReportReasonResource;
use App\Models\ReportReasonType;
use App\Services\AuthService;

class GetController extends Controller
{
    /**
     * @param ReportReasonType $reportReason
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ReportReasonType $reportReason)
    {
        return response()->json(['report' => new ReportReasonResource($reportReason)]);
    }
}
