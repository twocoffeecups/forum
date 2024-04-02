<?php

namespace App\Http\Controllers\Api\Dashboard\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Forum\ForumUpdateRequest;
use App\Models\Forum;

class UpdateController extends Controller
{
    /**
     * @param ForumUpdateRequest $request
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ForumUpdateRequest $request, Forum $forum): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $forum->fill($data);
        $forum->save();
        return response()->json(['message' => 'Forum updated!']);
    }
}
