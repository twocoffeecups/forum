<?php

namespace App\Http\Controllers\Client\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Topic\FilterRequest;
use App\Http\Resources\Forum\Forum\ForumResource;
use App\Models\Forum;


class ForumController extends Controller
{

    /**
     * @param FilterRequest $request
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(FilterRequest $request, Forum $forum): \Illuminate\Http\JsonResponse
    {
        return response()->json(['forum' => new ForumResource($forum)]);
    }

}
