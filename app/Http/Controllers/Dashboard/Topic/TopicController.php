<?php

namespace App\Http\Controllers\Dashboard\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Topic\RejectTopicRequest;
use App\Http\Requests\Dashboard\Topic\TopicDeleteRequest;
use App\Http\Resources\Dashboard\Topic\RejectedTopicResource;
use App\Http\Resources\Dashboard\Topic\TopicDetailsResource;
use App\Http\Resources\Dashboard\Topic\TopicResource;
use App\Models\Topic;
use App\Models\RejectedTopic;
use App\Notifications\TopicRejected;

class TopicController extends Controller
{

    public function index()
    {
        $topics = Topic::all();
        return response()->json(['topics' => TopicResource::collection($topics)]);
    }

    public function rejectedTopic()
    {
        $topics = RejectedTopic::all();
        return response()->json(['topics' => RejectedTopicResource::collection($topics)]);
    }

    public function show(Topic $topic)
    {
        return response()->json(['topic' => new TopicDetailsResource($topic)]);
    }

    public function resolve(Topic $topic)
    {
        $rejectedTopic = RejectedTopic::where('topicId', '=', $topic->id)->first();
        if($rejectedTopic){
            $rejectedTopic->delete();
        }
        $topic->status = 1;
        $topic->save();
        return response()->json(['message' => 'The topic is approved.']);
    }

    public function reject(RejectTopicRequest $request, Topic $topic)
    {

        $rejectedTopic = RejectedTopic::where('topicId', '=', $topic->id)->first();
        if($rejectedTopic){
            return response()->json(['message' => 'You have already added a comment to reject to publish the topic.']);
        }
        $data = $request->validated();
        $data['userId'] = $topic->userId;
        $data['topicId'] = $topic->id;
        //dd($data);
        $rejectedTopic = RejectedTopic::firstOrCreate(['topicId' => $data['topicId']], $data);
        // user notification
        $topic->author->notify(new TopicRejected($topic, $data['message']));
        $topic->status = 0;
        $topic->save();
        return response()->json(['message' => 'The topic is not approved.']);
    }

    protected function delete(TopicDeleteRequest $request, Topic $topic)
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
