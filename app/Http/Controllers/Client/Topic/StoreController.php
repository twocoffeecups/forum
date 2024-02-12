<?php

namespace App\Http\Controllers\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Topic\TopicStoreRequest;
use App\Http\Resources\Forum\Topic\TopicResource;
use App\Services\AuthService;
use App\Services\Forum\Topic\CreateTopic;

class StoreController extends Controller
{
    use CreateTopic;

    /**
     * @param TopicStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TopicStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = AuthService::getAuthorizedUser($request);
        if($user->isBanned()){
            AuthService::checkEndOfBan($user);
        }
        $topic = $this->createTopic($user, $data);
        return response()->json([
            'message' => 'Topic created',
            'topicId' => $topic->id,
            'topic' => new TopicResource($topic),
        ]);
    }
}
