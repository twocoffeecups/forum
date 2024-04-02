<?php

namespace App\Http\Controllers\Api\Forum\ForumCategory;

use App\Http\Controllers\Controller;
use App\Models\Forum;

class GetController extends Controller
{
    /**
     * Get forum category
     * @param Forum $forumCategories
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Forum $forumCategories): \Illuminate\Http\JsonResponse
    {
        return response()->json(['forumCategory' => $forumCategories]);
    }

//    public function getForumTree()
//    {
//        $forums = TreeBuilder::getTree(Forum::all());
//        $tags = Tag::all();
//        return response()->json([
//            'forums' => TopicForumTreeResource::collection($forums),
//            'tags' => TopicTagFormResource::collection($tags),
//        ]);
//    }
}
