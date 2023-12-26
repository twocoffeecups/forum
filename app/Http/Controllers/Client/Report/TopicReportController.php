<?php

namespace App\Http\Controllers\Client\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Report\ReportRequest;
use App\Models\Topic;

class TopicReportController extends Controller
{
    public function __invoke(ReportRequest $request, Topic $topic)
    {
        $data = $request->validated();
        $user = $this->getUserByToken($request);
        $data['userId'] = $topic->author->id;
        $data['senderId'] = $user->id;
        dd('TOPIC', $data, $topic, $user);
        return response()->json(['message' => 'Your complaint has been successfully sent. The administration will sort it out after receiving it.']);
    }
}
