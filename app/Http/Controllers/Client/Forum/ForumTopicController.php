<?php

namespace App\Http\Controllers\Client\Forum;

use App\Http\Controllers\Controller;
use App\Http\Filters\Forum\TopicFilter;
use App\Http\Requests\Client\Topic\FilterRequest;
use App\Http\Resources\Forum\Forum\TopicResource;
use App\Models\Forum;
use App\Models\Topic;


class ForumTopicController extends Controller
{

    /**
     * @param FilterRequest $request
     * @param Forum $forum
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __invoke(FilterRequest $request, Forum $forum)
    {
        $filters = $request->validated();
        $filtered = app()->make(TopicFilter::class, ['queryParams' => array_filter($filters)]);
        $topics = Topic::filter($filtered)->where('forumId', '=', $forum->id)->paginate(10, ['*'], 'page', $filters['page']);
        return TopicResource::collection($topics);
    }

}
