<?php

namespace App\Http\Controllers\Api\Client\UserProfile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Forum\Post\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GetPostsController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PaginateRequest $request, User $user): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = $request->validated();
        $posts = Post::where('userId', $user->id)
            ->whereExists(function ($query) {
                $query
                    ->select(DB::raw('*'))
                    ->from('topics')
                    ->whereColumn('topics.id', 'posts.topicId')
                    ->where('topics.private', '!=', 1);
            })
            ->paginate(5, ['*'], 'page', $data['page']);
        return PostResource::collection($posts);
    }
}
