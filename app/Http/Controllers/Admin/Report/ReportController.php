<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Paginate\PaginateRequest;
use App\Http\Resources\Admin\Report\ReportResource;
use App\Models\Report;

class ReportController extends Controller
{

    public function index(PaginateRequest $request)
    {
        $data = $request->validated();
        $reports = Report::paginate($data['entriesOnPage'], ['*'], 'page', $data['page']);
        return ReportResource::collection($reports);
    }

    public function show(Report $report)
    {
        return response()->json(['report' => $report]);
    }
}
