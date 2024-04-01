<?php

namespace App\Http\Controllers\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Topic\TopicResource;
use App\Models\Topic;
use App\Services\AuthService;
use Illuminate\Http\Request;

class UnapprovedTopicController extends Controller
{
    protected function show(Request $request, Topic $topic)
    {
        $user = AuthService::getAuthorizedUser($request);
        if(($topic->userId!==$user->id && $topic->status!==0) || !$user->admin()){
            return response()->json(['message' => "Topic not found"], 404);
        }
        return response()->json(['topic' => new TopicResource($topic)]);
    }
}
