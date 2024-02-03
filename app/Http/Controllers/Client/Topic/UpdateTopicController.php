<?php

namespace App\Http\Controllers\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Topic\TopicUpdateRequest;
use App\Models\Topic;
use App\Services\Forum\Topic\UpdateTopic;

class UpdateTopicController extends Controller
{
    use UpdateTopic;

    /**
     * @param TopicUpdateRequest $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TopicUpdateRequest $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        /** Update topic */
        $topic = $this->updateTopic($topic, $data);
        return $topic
            ? $this->topicUpdatedSuccessfullyResponse($topic)
            : $this->failedToUpdateTopicResponse();
    }

}
