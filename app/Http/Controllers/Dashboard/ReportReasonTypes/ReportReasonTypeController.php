<?php

namespace App\Http\Controllers\Dashboard\ReportReasonTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Requests\Dashboard\Report\ReportReasonStoreRequest;
use App\Http\Requests\Dashboard\Report\ReportReasonUpdateRequest;
use App\Http\Resources\Dashboard\Report\ReportReasonResource;
use App\Models\ReportReasonType;
use App\Services\AuthService;

class ReportReasonTypeController extends Controller
{

    public function index(PaginateRequest $request)
    {
        $data = $request->validated();
        $reportReasons = ReportReasonType::paginate(10, ['*'], 'page', $data['page']);
        return ReportReasonResource::collection($reportReasons);
    }

    public function store(ReportReasonStoreRequest $request)
    {
        $data = $request->validated();
        $user = AuthService::getAuthorizedUser($request);
        $data['authorId'] = $user->id;
        $reportReason = ReportReasonType::firstOrCreate($data);
        return response()->json([
            'message' => 'Report reason type created!',
            'reportReason'=> new ReportReasonResource($reportReason),
        ]);
    }

    public function show(ReportReasonType $reportReason)
    {
        return response()->json(['report' => new ReportReasonResource($reportReason)]);
    }

    public function update(ReportReasonUpdateRequest $request, ReportReasonType $reportReason)
    {
        $data = $request->validated();
        foreach ($data as $key => $value){
            $reportReason->$key = $value;
        }
        $reportReason->save();
        return response()->json(['message' => 'Report reason type updated!']);
    }

    public function delete(ReportReasonType $reportReason)
    {
        if(count($reportReason->reports)!==0){
            return response()->json(['message' => 'Deletion is not possible! There are reports about this.'], 413);
        }
        $reportReason->delete();
        return response()->json(['message' => 'Report reason type deleted successfully!']);
    }

    public function status(ReportReasonType $reportReason)
    {
        $reportReason->status = !$reportReason->status;
        $reportReason->save();
        return response()->json(['message' => 'Report reason type status changed']);
    }

    public function allForForm()
    {
        $reportReasons = ReportReasonType::all()->where('status', '=', 1);
        return response()->json(['reportReasonTypes' => ReportReasonResource::collection($reportReasons)]);
    }
}
