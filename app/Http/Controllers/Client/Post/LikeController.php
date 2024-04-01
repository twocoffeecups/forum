<?php

namespace App\Http\Controllers\Client\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Post\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostLiked;
use App\Services\AuthService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * @param Post $post
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, Post $post): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getAuthorizedUser($request);
        $post->likes()->toggle($user->id);
        // post liked notify
        $post->author->notify(new PostLiked($user, $post, $post->topic));
        return response()->json([
            'message' => 'Success.',
            'post' => new PostResource($post),
        ]);
    }
}
