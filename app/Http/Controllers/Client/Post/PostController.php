<?php

namespace App\Http\Controllers\Client\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Post\PostStoreRequest;
use App\Http\Requests\Api\Client\Post\PostUpdateRequest;
use App\Http\Resources\Client\Post\PostResource;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    /**
     * @param PostStoreRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function store(PostStoreRequest $request, User $user): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $data['userId'] = $user->id;
        $post = Post::firstOrCreate($data);
        return response()->json([
            'message' => 'The post created.',
            'post' => new PostResource($post),
        ]);
    }

    /**
     * @param PostUpdateRequest $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    protected function update(PostUpdateRequest $request, Post $post): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        foreach($data as $key => $value) {
            $post->$key = $value;
        }
        $post->save();
        return response()->json([
            'message' => 'The post updated.',
            'post' => new PostResource($post),
        ]);
    }

    /**
     * @param Post $post
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function bookmarks(Post $post, User $user): \Illuminate\Http\JsonResponse
    {
        $user->bookmarks()->toggle($post->id);
        return response()->json(['message' => 'Success.']);
    }

    /**
     * @param Post $post
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function like(Post $post , User $user): \Illuminate\Http\JsonResponse
    {
        $user->likes()->toggle($post->id);
        return response()->json(['message' => 'Success.']);
    }

}
