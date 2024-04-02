<?php

namespace App\Http\Controllers\Api\Forum\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Forum\Post\PostResource;
use App\Models\Post;
use App\Models\Settings;
use App\Models\Topic;

class GetPostsController extends Controller
{
    /**
     * Get all topic's posts
     * @param PaginateRequest $request
     * @param Topic $topic
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PaginateRequest $request, Topic $topic)
    {
        $postsOnPage = Settings::getPostsOnPageValue();
        $paginate = $request->validated();
        $posts = Post::where('topicId', '=', $topic->id)->paginate($postsOnPage, '*', 'page', $paginate['page']);
        return PostResource::collection($posts);
    }
}
