<?php

namespace App\Http\Controllers\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Topic\TopicResource;
use App\Models\Topic;
use App\Services\AuthService;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getAuthorizedUser($request);
        $user->topicBookmarks()->toggle($topic->id);
        return response()->json([
            'message' => 'Change topic bookmarks.',
            'topic' => new TopicResource($topic),
        ]);
    }
}
