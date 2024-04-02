<?php

namespace App\Http\Controllers\Api\Forum\Topic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Topic\TopicEditResource;
use App\Http\Resources\Forum\Topic\TopicForumTreeResource;
use App\Http\Resources\Forum\Topic\TopicResource;
use App\Http\Resources\Forum\Topic\TopicTagFormResource;
use App\Libraries\TreeBuilder;
use App\Models\Forum;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\TopicView;
use App\Services\AuthService;
use Illuminate\Http\Request;

class GetFormResourcesController extends Controller
{
//    /**
//     * @param Request $request
//     * @param Topic $topic
//     * @return \Illuminate\Http\JsonResponse
//     */
//    protected function show(Request $request, Topic $topic): \Illuminate\Http\JsonResponse
//    {
//        /** save topic view */
//        $user = AuthService::getAuthorizedUser($request);
//        $view = TopicView::saveView($request, $topic);
//        if ($topic->status === 0 && ($topic->userId != $user->id)) {
//            return response()->json(['message' => "Topic not found"], 404);
//        }
//        return response()->json(['topic' => new TopicResource($topic)]);
//    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function createFormResources(): \Illuminate\Http\JsonResponse
    {
        $forums = TreeBuilder::getTree(Forum::all());
        $tags = Tag::all();
        return response()->json([
            'forums' => TopicForumTreeResource::collection($forums),
            'tags' => TopicTagFormResource::collection($tags),
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * TODO: переделать getter на фронте и удалить этот метод
     */
    public function topicTags(): \Illuminate\Http\JsonResponse
    {
        $tags = Tag::all();
        return response()->json([
            'tags' => TopicTagFormResource::collection($tags),
        ]);
    }
}
