<?php

namespace App\Http\Controllers\Client\Forum;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\ForumCategory\ForumCategoryResource;
use App\Models\Forum;

class ForumCategoryController extends Controller
{

    public function index()
    {
        $forumCategories = Forum::all()->where('type', '=', 0);
        //dd($forumCategories->toArray());
        return response()->json(['forums' => ForumCategoryResource::collection($forumCategories)]);
    }

    protected function show(Forum $forumCategories)
    {
        return response()->json(['forumCategory' => $forumCategories]);
    }

}
