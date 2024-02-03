<?php

namespace App\Http\Controllers\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\Stats\ForumStatsResource;
use App\Http\Resources\Client\Stats\LastUserResource;
use App\Http\Resources\Client\Topic\ActiveTopicResource;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;

class ActiveTopicsController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     * Get 4 active topics
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $topics = Topic::with('posts')->where('status', '=', '1')->orderBy('created_at', 'desc')->limit(4)->get();
        return response()->json(['topics' => ActiveTopicResource::collection($topics)]);
    }

}
