<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Paginate\PaginateRequest;
use App\Http\Requests\Admin\Report\ProcessReportRequest;
use App\Http\Requests\Admin\Report\RejectReportRequest;
use App\Http\Resources\Admin\Report\ReportResource;
use App\Models\BanList;
use App\Models\Post;
use App\Models\RejectedTopic;
use App\Models\Report;
use App\Models\Topic;
use App\Models\User;
use App\Notifications\ReportProcessed;
use App\Notifications\ReportRejected;
use App\Notifications\ViolatedSiteRules;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
