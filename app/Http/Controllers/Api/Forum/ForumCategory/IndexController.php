<?php

namespace App\Http\Controllers\Api\Forum\ForumCategory;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\ForumCategory\ForumCategoryResource;
use App\Models\Forum;

class IndexController extends Controller
{

    /**
     * Get all published forum categories
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $forumCategories = Forum::all()->where('type', '=', 0);
        return response()->json(['forums' => ForumCategoryResource::collection($forumCategories)]);
    }
}
