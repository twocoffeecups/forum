<?php

namespace App\Http\Controllers\Api\Dashboard\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Topic\TopicDeleteRequest;
use App\Models\Topic;
use App\Models\RejectedTopic;

class DeleteController extends Controller
{
    /**
     * Delete topic
     * @param TopicDeleteRequest $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TopicDeleteRequest $request, Topic $topic)
    {
        $data = $request->validated();
        $rejectedTopic = RejectedTopic::where('topicId', '=', $topic->id)->first();
        if($rejectedTopic){
            $rejectedTopic->delete();
        }
        $topic->delete();
        return response()->json(['message' => 'The topic deleted.']);
    }
}
