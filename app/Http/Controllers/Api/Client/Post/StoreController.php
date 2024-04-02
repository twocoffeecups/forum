<?php

namespace App\Http\Controllers\Api\Client\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Post\PostStoreRequest;
use App\Models\Topic;
use App\Services\AuthService;
use App\Services\Forum\Post\PostService;

class StoreController extends Controller
{
    use PostService;

    /**
     * @param PostStoreRequest $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(PostStoreRequest $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getAuthorizedUser($request);
        $data = $request->validated();
        if ($user->isBanned()) {
            AuthService::checkEndOfBan($user);
        }
        $post = $this->createPost($topic, $user, $data);
        return $post
            ? $this->postCreatedSuccessfullyResponse($post)
            : $this->failedToCreatePostResponse();
    }
}
