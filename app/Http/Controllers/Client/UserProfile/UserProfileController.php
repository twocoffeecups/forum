<?php

namespace App\Http\Controllers\Client\UserProfile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Paginate\PaginateRequest;
use App\Http\Resources\Client\Forum\TopicResource;
use App\Http\Resources\Client\Post\PostResource;
use App\Http\Resources\Client\Profile\UserResource;
use App\Http\Resources\Client\UserProfile\UserProfileResource;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;

class UserProfileController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(User $user): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'userDetails' => new UserProfileResource($user),
        ]);
    }

    /**
     * @param PaginateRequest $request
     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getUserTopics(PaginateRequest $request, User $user): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = $request->validated();
        $topics = Topic::where('userId', $user->id)->paginate(5, ['*'], 'page', $data['page']);
        return TopicResource::collection($topics);
    }

    /**
     * @param PaginateRequest $request
     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getUserPosts(PaginateRequest $request, User $user): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = $request->validated();
        $posts = Post::where('userId', $user->id)->paginate(5, ['*'], 'page', $data['page']);
        return PostResource::collection($posts);
    }

}
