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
