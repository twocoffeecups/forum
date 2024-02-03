<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Report\ProcessReportRequest;
use App\Models\Report;
use App\Services\Dashboard\Report\ReportProcessing;

class ReportProcessingController extends Controller
{
    use ReportProcessing;

    /**
     * action on object(delete or reject)
     */
    public const ACTION_REJECTED = 'rejected';
    public const ACTION_DELETED = 'deleted';

    /**
     * @param ProcessReportRequest $request
     * @param Report $report

     */
    public function __invoke(ProcessReportRequest $request, Report $report)
    {
        $data = $request->validated();
        /** Report processing */
        $this->startTheReportProcessing($report, $data);
    }

}
