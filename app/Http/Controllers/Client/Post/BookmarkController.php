<?php

namespace App\Http\Controllers\Client\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Post\PostStoreRequest;
use App\Http\Requests\Api\Client\Post\PostUpdateRequest;
use App\Http\Resources\Client\Post\PostResource;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use App\Notifications\PostLiked;
use App\Services\AuthService;
use App\Services\Forum\Post\PostService;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * @param Post $post
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, Post $post): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getAuthorizedUser($request);
        $post->bookmarks()->toggle($user->id);
        return response()->json([
            'message' => 'Success.',
            'post' => new PostResource($post),
        ]);
    }
}
