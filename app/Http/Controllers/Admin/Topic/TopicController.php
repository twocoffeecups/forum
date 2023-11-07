<?php

namespace App\Http\Controllers\Admin\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Topic\UnApprovedTopicRequest;
use App\Models\Topic;
use App\Models\UnApprovedTopic;

class TopicController extends Controller
{

    public function approved(Topic $topic)
    {
        $unApprovedTopic = UnApprovedTopic::where('topicId', '=', $topic->id)->first();
        if($unApprovedTopic){
            $unApprovedTopic->delete();
        }
        $topic->status = 1;
        $topic->save();
        return response()->json(['message' => 'The topic is approved.']);
    }

    public function doNotApprove(UnApprovedTopicRequest $request, Topic $topic)
    {

        $unApprovedTopic = UnApprovedTopic::where('topicId', '=', $topic->id)->first();
        if($unApprovedTopic){
            return response()->json(['message' => 'You have already added a comment to the refusal to publish the topic.']);
        }
        $data = $request->validated();
        $data['userId'] = $topic->userId;
        UnApprovedTopic::firstOrCreate(['topicId' => $data['topicId']], $data);
        $topic->status = 0;
        $topic->save();
        return response()->json(['message' => 'The topic is not approved.']);
    }

    protected function delete(Topic $topic)
    {
        $unApprovedTopic = UnApprovedTopic::where('topicId', '=', $topic->id)->first();
        if($unApprovedTopic){
            $unApprovedTopic->delete();
        }
        $topic->delete();
        return response()->json(['message' => 'The topic deleted.']);
    }
}
