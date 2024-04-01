<?php

namespace App\Http\Controllers\Dashboard\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Dashboard\Report\ReportResource;
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

    /**
     * @param Report $report
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Report $report): \Illuminate\Http\JsonResponse
    {
        return response()->json(['report' => new ReportResource($report)]);
    }
}
