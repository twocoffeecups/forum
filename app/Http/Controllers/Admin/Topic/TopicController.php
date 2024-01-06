<?php

namespace App\Http\Controllers\Admin\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Topic\RejectTopicRequest;
use App\Http\Requests\Admin\Topic\TopicDeleteRequest;
use App\Http\Resources\Admin\Topic\RejectedTopicResource;
use App\Http\Resources\Admin\Topic\TopicDetailsResource;
use App\Http\Resources\Admin\Topic\TopicResource;
use App\Models\Topic;
use App\Models\RejectedTopic;

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
        //dd($topics);
        return response()->json(['topics' => RejectedTopicResource::collection($topics)]);
    }

    public function show(Topic $topic)
    {
        return response()->json(['topic' => new TopicDetailsResource($topic)]);
    }

    public function resolve(Topic $topic)
    {
        $rejectedTopic = RejectedTopic::where('topicId', '=', $topic->id)->first();
        //dd($topic, $rejectedTopic);
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
        //dd($data, $rejectedTopic);
        $rejectedTopic = RejectedTopic::firstOrCreate(['topicId' => $data['topicId']], $data);
        $topic->status = 0;
        $topic->save();
        return response()->json(['message' => 'The topic is not approved.']);
    }

    protected function delete(TopicDeleteRequest $request, Topic $topic)
    {
        $data = $request->validated();
        $rejectedTopic = RejectedTopic::where('topicId', '=', $topic->id)->first();
        //dd($data, $topic, $rejectedTopic);
        if($rejectedTopic){
            $rejectedTopic->delete();
        }
        $topic->delete();
        return response()->json(['message' => 'The topic deleted.']);
    }
}
