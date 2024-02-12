<?php

namespace App\Http\Controllers\Client\Report;

use App\Http\Controllers\Controller;
use App\Models\ReportReasonType;


class ReportController extends Controller
{

    public function __invoke()
    {
        $reportTypes = ReportReasonType::all();
        return response()->json(['reportTypes' => $reportTypes]);
    }

}
