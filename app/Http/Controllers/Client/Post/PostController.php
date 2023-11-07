<?php

namespace App\Http\Controllers\Client\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Post\PostStoreRequest;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    protected function store(PostStoreRequest $request, User $user)
    {
        $data = $request->validated();
        //dd($data, $user->id);
        $data['userId'] = $user->id;
        //dd($data);
        $post = Post::firstOrCreate($data);
        return response()->json([
            'message' => 'The post created.',
            'post' => $post,
        ]);
    }

    protected function bookmarks(Post $post, User $user)
    {
        $user->bookmarks()->toggle($post->id);
        return response()->json(['message' => 'Success.']);
    }

    protected function like(Post $post , User $user)
    {
        $user->likes()->toggle($post->id);
        return response()->json(['message' => 'Success.']);
    }

}
