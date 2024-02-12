<?php

namespace App\Http\Controllers\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Post\PostResource;
use App\Models\Post;
use App\Models\Topic;

class TopicPostController extends Controller
{

    public function index(Topic $topic)
    {
        $posts = Post::all()->where('topicId', '=', $topic->id);
        return response()->json(['posts' => PostResource::collection($posts)]);
    }

}
