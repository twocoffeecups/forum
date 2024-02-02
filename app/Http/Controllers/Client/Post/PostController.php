<?php

namespace App\Http\Controllers\Client\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Post\PostStoreRequest;
use App\Http\Requests\Api\Client\Post\PostUpdateRequest;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use App\Notifications\PostLiked;
use App\Services\AuthService;
use App\Services\Post\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use PostService;

    /**
     * @param PostStoreRequest $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function store(PostStoreRequest $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getAuthorizedUser($request);
        $data = $request->validated();
        if($user->isBanned()){
            AuthService::checkEndOfBan($user);
        }
        $post = $this->createPost($topic, $user, $data);
        return $post
            ? $this->postCreatedSuccessfullyResponse($post)
            : $this->failedToCreatePostResponse();
    }

    /**
     * @param PostUpdateRequest $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    protected function update(PostUpdateRequest $request, Post $post): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $post = $this->updatePost($post, $data);
        return response()->json(['message' => 'Post update successfully.']);
    }

    /**
     * @param Post $post
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function bookmarks(Request $request, Post $post): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getAuthorizedUser($request);
        $post->likes()->toggle($user->id);
        return response()->json(['message' => 'Success.']);
    }

    /**
     * @param Post $post
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function like(Request $request, Post $post): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getAuthorizedUser($request);
        $post->bookmarks()->toggle($user->id);
        // post liked notify
        $post->author->notify(new PostLiked($user, $post));
        return response()->json(['message' => 'Success.']);
    }
}
