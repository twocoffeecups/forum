<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Paginate\PaginateRequest;
use App\Http\Requests\Admin\Report\RejectReportRequest;
use App\Http\Resources\Admin\Report\ReportResource;
use App\Models\Report;

class ReportController extends Controller
{

    /**
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(PaginateRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = $request->validated();
        $reports = Report::paginate($data['entriesOnPage'], ['*'], 'page', $data['page']);
        return ReportResource::collection($reports);
    }

    public function reject(RejectReportRequest $request, Report $report)
    {
        $data = $request->validated();
        // TODO: сделать уведомления
        // sender notification

        $report->delete();
        return response()->json(['message' => 'Report deleted. Messages about the reason were sent to the user.']);
    }

    /**
     * @param Report $report
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Report $report): \Illuminate\Http\JsonResponse
    {
        return response()->json(['report' => new ReportResource($report)]);
    }
}
