<?php

namespace App\Http\Controllers\Client\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Post\PostUpdateRequest;
use App\Models\Post;
use App\Services\Forum\Post\PostService;

class UpdateController extends Controller
{
    use PostService;

    /**
     * @param PostUpdateRequest $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(PostUpdateRequest $request, Post $post): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $post = $this->updatePost($post, $data);
        return response()->json(['message' => 'Post update successfully.']);
    }
}
