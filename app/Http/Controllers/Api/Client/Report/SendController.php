<?php

namespace App\Http\Controllers\Api\Client\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Report\ReportRequest;
use App\Services\AuthService;
use App\Services\Forum\Report\SendReport;


class SendController extends Controller
{
    use SendReport;
    const REPORT_OBJECTS_TYPE = ['topic', 'post'];

    public function __invoke(ReportRequest $request)
    {
        $data = $request->validated();
        $user = AuthService::getAuthorizedUser($request);
        /** Send report */
        return $this->sendReport($user, $data)
            ? $this->reportSendSuccessfullyResponse()
            : $this->failedToSendReportResponse();
    }
}
