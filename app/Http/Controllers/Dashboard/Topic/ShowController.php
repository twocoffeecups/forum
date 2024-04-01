<?php

namespace App\Http\Controllers\Dashboard\Topic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Topic\TopicDetailsResource;
use App\Models\Topic;

class ShowController extends Controller
{
    /**
     * Show topic
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Topic $topic)
    {
        return response()->json(['topic' => new TopicDetailsResource($topic)]);
    }
}
