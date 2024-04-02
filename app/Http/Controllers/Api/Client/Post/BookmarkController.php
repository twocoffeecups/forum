<?php

namespace App\Http\Controllers\Api\Client\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Post\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Services\AuthService;
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
