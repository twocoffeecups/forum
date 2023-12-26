<?php

namespace App\Http\Controllers\Client\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Report\ReportRequest;
use App\Models\Post;
use App\Models\Report;


class PostReportController extends Controller
{
    public function __invoke(ReportRequest $request, Post $post)
    {
        $data = $request->validated();
        $user = $this->getUserByToken($request);
        $data['userId'] = $post->author->id;
        $data['senderId'] = $user->id;
        //dd('POST', $data, $post, $user);
        $report = Report::create($data);
        return response()->json(['message' => 'Your complaint has been successfully sent. The administration will sort it out after receiving it.']);
    }
}
