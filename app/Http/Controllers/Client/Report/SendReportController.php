<?php

namespace App\Http\Controllers\Client\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Report\ReportRequest;
use App\Models\Post;
use App\Models\Report;
use App\Services\AuthService;


class SendReportController extends Controller
{
    const REPORT_OBJECTS_TYPE = ['topic', 'post'];

    public function __invoke(ReportRequest $request)
    {
        $data = $request->validated();
        $user = AuthService::getUserByToken($request);
        if(!in_array($data['object'], self::REPORT_OBJECTS_TYPE)){
            return response()->json(['message' => 'Error! Incorrect data.'], 413);
        }
        $report = Report::where('senderId', $user->id)->where(function ($query) use($data) {
            if(!empty($data['topicId'])){
                $query->where('topicId', '=', $data['topicId']);
            }else {
                $query->where('postId', '=', $data['postId']);
            }
        })->get();
        if(count($report)!==0){
            return response()->json(['message' => 'You have already sent a report. It is currently being processed.'], 413);
        }
        $data['senderId'] = $user->id;
        $report = Report::create($data);
        return response()->json(['message' => 'Your complaint has been successfully sent. The administration will sort it out after receiving it.']);
    }
}
