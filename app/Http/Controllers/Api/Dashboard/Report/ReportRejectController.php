<?php

namespace App\Http\Controllers\Api\Dashboard\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Report\RejectReportRequest;
use App\Http\Resources\Dashboard\Report\ReportResource;
use App\Models\Report;
use App\Notifications\ReportRejected;

class ReportRejectController extends Controller
{
    public function __invoke(RejectReportRequest $request, Report $report)
    {
        $data = $request->validated();
        // send notification
        $report->sender->notify(new ReportRejected($report, $data['message']));
        $report->status = 1;
        $report->closed = 1;
        $report->save();
        return response()->json([
            'message' => 'Report deleted. Messages about the reason were sent to the user.',
            'report' => new ReportResource($report),
        ]);
    }
}
