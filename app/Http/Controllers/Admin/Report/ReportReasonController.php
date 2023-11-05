<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Report\ReportReasonStoreRequest;
use App\Http\Requests\Admin\Report\ReportReasonUpdateRequest;
use App\Http\Resources\Admin\Report\ReportReasonResource;
use App\Models\ReportReason;

class ReportReasonController extends Controller
{

    public function index()
    {
        return response()->json(['reportReasons' => ReportReasonResource::collection(ReportReason::all())]);
    }

    public function store(ReportReasonStoreRequest $request)
    {
        $data = $request->validated();
        $reportReason = ReportReason::firstOrCreate($data);
        return response()->json([
            'message' => 'Report created!',
            'reportReason'=>$reportReason,
        ]);
    }

    public function show(ReportReason $reportReason)
    {
        return response()->json(['report' => new ReportReasonResource($reportReason)]);
    }

    public function update(ReportReasonUpdateRequest $request, ReportReason $reportReason)
    {
        $data = $request->validated();
        //dd($data);
        foreach ($data as $key => $value){
            $reportReason->$key = $value;
        }
        $reportReason->save();
        return response()->json(['message' => 'Report updated!']);
    }

    public function delete(ReportReason $reportReason)
    {
        $reportReason->delete();
        return response()->json(['message' => 'Report type deleted successfully!']);
    }

    public function status(ReportReason $reportReason)
    {
        $reportReason->status = !$reportReason->status;
        $reportReason->save();
        return response()->json(['message' => 'Report reason status changed']);
    }
}
