<?php

namespace App\Services\Forum\Report;

use App\Models\Report;
use App\Models\User;

trait SendReport
{
    protected function sendReport(User $user, array $data)
    {
        if($this->checkIfDataIsCorrect($data['object'])){
            return false;
        }
        if($this->checkIfReportExists($user, $data)){
            return $this->userHasAlreadySentReport();
        }
        return $this->store($user, $data);
    }

    protected function store(User $user, array $data)
    {
        $data['senderId'] = $user->id;
        $report = Report::create($data);
        return $report;
    }

    protected function checkIfDataIsCorrect(string $data)
    {
        if(!in_array($data, self::REPORT_OBJECTS_TYPE)){
            return response()->json(['message' => 'Error! Incorrect data.'], 413);
        }
    }

    protected function checkIfReportExists(User $user, $data): bool
    {
        $report = Report::where('senderId', $user->id)->where(function ($query) use($data) {
            if(!empty($data['topicId'])){
                $query->where('topicId', '=', $data['topicId']);
            }else {
                $query->where('postId', '=', $data['postId']);
            }
        })->get();
        return (bool) count($report)!=0;
    }

    protected function reportSendSuccessfullyResponse(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'Your complaint has been successfully sent. The administration will sort it out after receiving it.',
        ])->sendContent();
    }

    protected function userHasAlreadySentReport(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'You have already sent a report. It is currently being processed.'
        ], 413)->sendContent();
    }

    protected function failedToSendReportResponse(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'Failed to send report.',
        ], 404)->sendContent();
    }


}
