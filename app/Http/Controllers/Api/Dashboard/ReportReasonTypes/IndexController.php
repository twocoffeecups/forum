<?php

namespace App\Http\Controllers\Api\Dashboard\ReportReasonTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Dashboard\Report\ReportReasonResource;
use App\Models\ReportReasonType;

class IndexController extends Controller
{
    /**
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PaginateRequest $request)
    {
        $data = $request->validated();
        $reportReasons = ReportReasonType::paginate(10, ['*'], 'page', $data['page']);
        return ReportReasonResource::collection($reportReasons);
    }
}
