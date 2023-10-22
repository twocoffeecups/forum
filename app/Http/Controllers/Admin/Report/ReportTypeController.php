<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportTypeRequest;
use App\Http\Resources\Admin\Report\ReportTypeResource;
use App\Models\ReportReason;
use Illuminate\Http\Request;

class ReportTypeController extends Controller
{

    public function index(){
        return response()->json(['reportTypes' => ReportTypeResource::collection(ReportReason::all())]);
    }

    public function store(ReportTypeRequest $request){
        $data = $request->validated();
        //dd($data);
        $reportType = ReportReason::firstOrCreate($data);
        return response()->json(['message' => 'Report created!']);
    }

    public function show(ReportReason $reportType){
        return response()->json(['report' => new ReportReason($reportType)]);
    }

    public function update(ReportTypeRequest $request, ReportReason $reportType){
        $data = $request->validated();
        //dd($data);
        $reportType->name = $data['name'];
        $reportType->description = $data['description'];
        $reportType->save();
        return response()->json(['message' => 'Report updated!']);
    }

    public function delete(ReportReason $reportType){
        $reportType->delete();
        return response()->json(['message' => 'Report type deleted successfully!']);
    }
}
