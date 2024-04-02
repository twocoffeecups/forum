<?php

namespace App\Http\Controllers\Api\Client\UserProfile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Client\UserProfile\UserProfileResource;
use App\Http\Resources\Forum\Forum\TopicResource;
use App\Http\Resources\Forum\Post\PostResource;
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

     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getUserTopics(PaginateRequest $request, User $user): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = $request->validated();
        $topics = Topic::where('userId', $user->id)->paginate(5, ['*'], 'page', $data['page']);
        //dd($topics);
        return TopicResource::collection($topics);
    }

    /**

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
