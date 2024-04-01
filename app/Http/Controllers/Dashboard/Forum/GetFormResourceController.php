<?php

namespace App\Http\Controllers\Dashboard\Forum;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Forum\CreateForumFormResource;
use App\Models\Forum;
class GetFormResourceController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $forums = Forum::all();
        return response()->json(['forums' => CreateForumFormResource::collection($forums)]);
    }

}
