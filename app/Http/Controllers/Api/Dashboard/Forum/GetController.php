<?php

namespace App\Http\Controllers\Api\Dashboard\Forum;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Forum\ForumDetailsResource;
use App\Models\Forum;

class GetController extends Controller
{
    /**
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Forum $forum): \Illuminate\Http\JsonResponse
    {
        return response()->json(['forum' => new ForumDetailsResource($forum)]);
    }
}
