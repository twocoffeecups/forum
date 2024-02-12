<?php

namespace App\Http\Controllers\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Topic\TopicResource;
use App\Models\Topic;
use App\Notifications\TopicLiked;
use App\Services\AuthService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getAuthorizedUser($request);
        $topic->likes()->toggle($user->id);
        $topic->author->notify(new TopicLiked($topic, $user));
        return response()->json([
            'message' => 'Change topic like.',
            'topic' => new TopicResource($topic),
        ]);
    }
}
