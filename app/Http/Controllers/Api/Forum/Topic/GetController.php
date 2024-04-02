<?php

namespace App\Http\Controllers\Api\Forum\Topic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Topic\TopicResource;
use App\Models\Topic;
use App\Models\TopicView;
use Illuminate\Http\Request;

class GetController extends Controller
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
