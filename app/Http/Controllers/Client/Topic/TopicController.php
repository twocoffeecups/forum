<?php

namespace App\Http\Controllers\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\Topic\TopicEditResource;
use App\Http\Resources\Client\Topic\TopicForumTreeResource;
use App\Http\Resources\Client\Topic\TopicResource;
use App\Http\Resources\Client\Topic\TopicTagFormResource;
use App\Libraries\TreeBuilder;
use App\Models\Forum;
use App\Models\Tag;
use App\Models\Topic;
use App\Notifications\TopicLiked;
use App\Services\AuthService;
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
        if ($topic->status === 0) {
            return response()->json(['message' => "Topic not found"], 404);
        }
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
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function like(Request $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getAuthorizedUser($request);
        $topic->likes()->toggle($user->id);
        $topic->author->notify(new TopicLiked($topic, $user));
        return response()->json(['message' => 'Change topic like.']);
    }

    /**
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function addToBookmarks(Request $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getAuthorizedUser($request);
        $user->topicBookmarks()->toggle($topic->id);
        return response()->json(['message' => 'Change topic bookmarks.']);
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
