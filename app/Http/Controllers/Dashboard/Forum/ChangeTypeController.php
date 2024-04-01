<?php

namespace App\Http\Controllers\Dashboard\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Forum\ChangeForumTypeRequest;
use App\Models\Forum;

class ChangeTypeController extends Controller
{
    /**
     * @param ChangeForumTypeRequest $request
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ChangeForumTypeRequest $request, Forum $forum): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        if (count($forum->topics) !== 0 && $data['type'] == 0) {
            return response()->json(['message' => 'It is impossible to change the type of forum. There are topics on this forum.'], 413);
        }
        if ($forum->parentId !== null) {
            $forum->parentId = null;
        }
        $forum->type = $data['type'];
        $forum->save();
        return response()->json(['message' => 'Forum type changed! To make the forum appear on the site, select a parent forum for it.']);
    }
}
