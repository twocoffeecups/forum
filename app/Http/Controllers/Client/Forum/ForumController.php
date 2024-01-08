<?php

namespace App\Http\Controllers\Client\Forum;

use App\Http\Controllers\Controller;
use App\Http\Filters\Forum\TopicFilter;
use App\Http\Requests\Api\Client\Topic\FilterRequest;
use App\Http\Resources\Client\Forum\ForumResource;
use App\Http\Resources\Client\Forum\TopicResource;
use App\Models\Forum;
use App\Models\Topic;


class ForumController extends Controller
{

    /**
     * @param FilterRequest $request
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __invoke(FilterRequest $request, Forum $forum): \Illuminate\Http\JsonResponse
    {
        $filters = $request->validated();
        $filtered = app()->make(TopicFilter::class, ['queryParams' => array_filter($filters)]);
        $topics = Topic::filter($filtered)->where('forumId', '=', $forum->id)->get();
        return response()->json([
            'forum' => new ForumResource($forum),
            'topics' => TopicResource::collection($topics),
        ]);
    }

}
