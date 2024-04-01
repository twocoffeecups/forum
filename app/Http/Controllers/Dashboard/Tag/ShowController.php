<?php

namespace App\Http\Controllers\Dashboard\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Forum\TagResource;
use App\Models\Tag;

class ShowController extends Controller
{
    /**
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Tag $tag): \Illuminate\Http\JsonResponse
    {
        return response()->json(['tag' => new TagResource($tag)]);
    }
}
