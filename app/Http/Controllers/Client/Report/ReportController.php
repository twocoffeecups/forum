<?php

namespace App\Http\Controllers\Client\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Report\ReportRequest;
use App\Models\Post;
use App\Models\ReportReason;
use App\Models\Topic;


class ReportController extends Controller
{

    public function index()
    {
        $reportTypes = ReportReason::all();
        return response()->json(['reportTypes' => $reportTypes]);
    }

    /** TODO: Переделать оба метода(savePostReport / saveTopicReport). Разделить на 2 контроллёра */
//    public function savePostReport(ReportRequest $request)
//    {
//        $data = $request->validated();
//        $user = $this->getUserByToken($request);
//        $post = Post::find($data['postId'])->first();
//        $data['userId'] = $post->author->id;
//        $data['senderId'] = $user->id;
//        dd('POST', $data, $post, $user);
//    }
//
//    public function saveTopicReport(ReportRequest $request)
//    {
//        $data = $request->validated();
//        $user = $this->getUserByToken($request);
//        $topic = Topic::find($data['postId'])->first();
//        $data['userId'] = $topic->author->id;
//        $data['senderId'] = $user->id;
//        dd('TOPIC', $data, $topic, $user);
//    }

}
