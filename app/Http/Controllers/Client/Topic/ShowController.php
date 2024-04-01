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
use App\Services\AuthService;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        // TODO: сделать доступ только автору и админу/модератору
        /** save topic view */
        $view = TopicView::saveView($request, $topic);
        return response()->json(['topic' => new TopicResource($topic)]);
    }
}
