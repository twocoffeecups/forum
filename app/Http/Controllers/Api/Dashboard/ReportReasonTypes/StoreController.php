<?php

namespace App\Http\Controllers\Api\Dashboard\ReportReasonTypes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Report\ReportReasonStoreRequest;
use App\Http\Resources\Dashboard\Report\ReportReasonResource;
use App\Models\ReportReasonType;
use App\Services\AuthService;

class StoreController extends Controller
{
    /**
     * @param ReportReasonStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ReportReasonStoreRequest $request)
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
}
