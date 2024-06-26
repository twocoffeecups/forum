<?php

namespace App\Http\Controllers\Api\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Topic\TopicUpdateRequest;
use App\Models\Topic;
use App\Services\Forum\Topic\UpdateTopic;

class UpdateController extends Controller
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
