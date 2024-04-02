<?php

namespace App\Http\Controllers\Api\Forum\Topic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Topic\TopicResource;
use App\Models\Topic;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $topics = Topic::allApprovedTopics();
        return response()->json(['topics' => TopicResource::collection($topics)]);
    }
}
