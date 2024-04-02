<?php

namespace App\Http\Controllers\Api\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Topic\TopicEditResource;
use App\Models\Topic;
use Illuminate\Http\Request;

class EditController extends Controller
{
    /**
     * Get topic for update
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        return response()->json(['topic' => new TopicEditResource($topic)]);
    }
}
