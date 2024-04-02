<?php

namespace App\Http\Controllers\Api\Dashboard\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Forum\ForumStoreRequest;
use App\Http\Resources\Dashboard\Forum\ForumResource;
use App\Models\Forum;
use App\Services\AuthService;

class StoreController extends Controller
{
    /**
     * @param ForumStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ForumStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = AuthService::getAuthorizedUser($request);
        if ($data['type'] == 0 && $data['parentId'] != 0) {
            unset($data['parentId']);
        }
        $data['status'] === 'true' ? $data['status'] = 1: $data['status'] = 0;
        $data['authorId'] = $user->id;
        $forum = Forum::firstOrCreate($data);
        return response()->json([
            'message' => 'Forum created!',
            'forum' => new ForumResource($forum),
        ]);
    }

}
