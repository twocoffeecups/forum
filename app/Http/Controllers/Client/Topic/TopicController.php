<?php

namespace App\Http\Controllers\Client\Topic;

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
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $topics = Topic::allApprovedTopics();
        return response()->json(['topics' => TopicResource::collection($topics)]);
    }

    /**
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function show(Request $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        // TODO: сделать доступ только автору и админу/модератору
        /** save topic view */
        $view = TopicView::saveView($request, $topic);
        if ($topic->status === 0) {
            return response()->json(['message' => "Topic not found"], 404);
        }
        //dd($topic->numberOfViews());
        return response()->json(['topic' => new TopicResource($topic)]);
    }

    /**
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function edit(Request $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
//        if($topic->status===0){
//            return response()->json(['message' => "Topic not found"], 404);
//        }
        return response()->json(['topic' => new TopicEditResource($topic)]);
    }

    /**
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function delete(Topic $topic): \Illuminate\Http\JsonResponse
    {
        if ($topic->posts != 0) {
            return response()->json(['message' => "You can't delete a topic because there are posts for it"], 406);
        }
        $topic->delete();
        return response()->json(['message' => 'Topic deleted.']);
    }

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
