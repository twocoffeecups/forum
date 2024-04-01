<?php

namespace App\Http\Controllers\Dashboard\Topic;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\RejectedTopic;

class ResolveController extends Controller
{
    /**
     * Resolve topic
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Topic $topic)
    {
        $rejectedTopic = RejectedTopic::where('topicId', '=', $topic->id)->first();
        if($rejectedTopic){
            $rejectedTopic->delete();
        }
        $topic->status = 1;
        $topic->save();
        return response()->json(['message' => 'The topic is approved.']);
    }
}
