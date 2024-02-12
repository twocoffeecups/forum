<?php

namespace App\Http\Controllers\Client\Forum;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\ForumCategory\ForumCategoryResource;
use App\Http\Resources\Forum\Topic\TopicForumTreeResource;
use App\Http\Resources\Forum\Topic\TopicTagFormResource;
use App\Libraries\TreeBuilder;
use App\Models\Forum;
use App\Models\Tag;

class ForumCategoryController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $forumCategories = Forum::all()->where('type', '=', 0);
        return response()->json(['forums' => ForumCategoryResource::collection($forumCategories)]);
    }

    /**
     * @param Forum $forumCategories
     * @return \Illuminate\Http\JsonResponse
     */
    protected function show(Forum $forumCategories): \Illuminate\Http\JsonResponse
    {
        return response()->json(['forumCategory' => $forumCategories]);
    }

    public function getForumTree()
    {
        $forums = TreeBuilder::getTree(Forum::all());
        $tags = Tag::all();
        return response()->json([
            'forums' => TopicForumTreeResource::collection($forums),
            'tags' => TopicTagFormResource::collection($tags),
        ]);
    }
}
