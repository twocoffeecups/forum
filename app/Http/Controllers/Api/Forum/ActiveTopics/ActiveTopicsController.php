<?php

namespace App\Http\Controllers\Api\Forum\ActiveTopics;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Topic\ActiveTopicResource;
use App\Models\Topic;

class ActiveTopicsController extends Controller
{

    /**
     * Get 4 active topics
     * @return \Illuminate\Http\JsonResponse
     * Get 4 active topics
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $topics = Topic::with('posts')
            ->where('status', '=', '1')
            ->where('private', '!=', 1)
            ->orderBy('created_at', 'desc')
            ->limit(4)->get();
        return response()->json(['topics' => ActiveTopicResource::collection($topics)]);
    }

}
