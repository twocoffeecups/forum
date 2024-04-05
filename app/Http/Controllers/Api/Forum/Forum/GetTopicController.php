<?php

namespace App\Http\Controllers\Api\Forum\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Topic\FilterRequest;
use App\Http\Resources\Forum\Forum\TopicResource;
use App\Models\Forum;
use App\Services\Forum\Topic\GetFilteredTopics;


class GetTopicController extends Controller
{
    use GetFilteredTopics;

    /**
     * Get forum topics
     * @param FilterRequest $request
     * @param Forum $forum
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __invoke(FilterRequest $request, Forum $forum)
    {
        $filters = $request->validated();
        $topics = $this->getTopics($filters, $forum->id, $request);
        return TopicResource::collection($topics);
    }
}
