<?php

namespace App\Http\Controllers\Dashboard\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Topic\RejectTopicRequest;
use App\Models\Topic;
use App\Models\RejectedTopic;
use App\Notifications\TopicRejected;

class RejectController extends Controller
{
    /**
     * Reject topic
     * @param RejectTopicRequest $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RejectTopicRequest $request, Topic $topic)
    {

        $rejectedTopic = RejectedTopic::where('topicId', '=', $topic->id)->first();
        if($rejectedTopic){
            return response()->json(['message' => 'You have already added a comment to reject to publish the topic.']);
        }
        $data = $request->validated();
        $data['userId'] = $topic->userId;
        $data['topicId'] = $topic->id;
        $rejectedTopic = RejectedTopic::firstOrCreate(['topicId' => $data['topicId']], $data);
        // user notification
        $topic->author->notify(new TopicRejected($topic, $data['message']));
        $topic->status = 0;
        $topic->save();
        return response()->json(['message' => 'The topic is not approved.']);
    }
}
