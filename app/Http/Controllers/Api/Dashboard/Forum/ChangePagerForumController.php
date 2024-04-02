<?php

namespace App\Http\Controllers\Api\Dashboard\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Forum\ChangeForumCategoryRequest;
use App\Models\Forum;

class ChangePagerForumController extends Controller
{
    /**
     * @param ChangeForumCategoryRequest $request
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ChangeForumCategoryRequest $request, Forum $forum): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $parent = Forum::find($data['parentId']);
        $forum->parent()->associate($parent);
        $forum->save();
        return response()->json(['message' => 'Forum parent category changed!']);

    }
}
