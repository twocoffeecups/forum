<?php

namespace App\Http\Controllers\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Forum\Post\PostResource;
use App\Models\Post;
use App\Models\Settings;
use App\Models\Topic;

class TopicPostController extends Controller
{
    public function __invoke(PaginateRequest $request, Topic $topic)
    {
        $postsOnPage = Settings::getPostsOnPageValue();
        $paginate = $request->validated();
        $posts = Post::where('topicId', '=', $topic->id)->paginate($postsOnPage, '*', 'page', $paginate['page']);
        return PostResource::collection($posts);
    }

}
