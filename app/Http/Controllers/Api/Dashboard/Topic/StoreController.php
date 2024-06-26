<?php

namespace App\Http\Controllers\Api\Dashboard\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Topic\StoreTopicRequest;
use App\Services\AuthService;
use App\Services\Forum\Topic\CreateTopic;
use App\Http\Resources\Forum\Topic\TopicResource;

class StoreController extends Controller
{
    use CreateTopic;

    /**
     * Create topic
     * @param StoreTopicRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(StoreTopicRequest $request)
    {
        $data = $request->validated();
        if((int) $data['type']!=1 && isset($data['closeComments'])){
           unset($data['closeComments']);
        }
        $user = AuthService::getAuthorizedUser($request);
        $topic = $this->createTopic($user, $data);
        return response()->json([
            'message' => 'Topic created',
            'topicId' => $topic->id,
            'topic' => new TopicResource($topic),
        ]);
    }
}
