<?php

namespace App\Http\Controllers\Dashboard\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Tag\TagStoreRequest;
use App\Http\Resources\Dashboard\Forum\TagResource;
use App\Models\Tag;
use App\Services\AuthService;

class StoreController extends Controller
{
    /**
     * @param TagStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TagStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = AuthService::getAuthorizedUser($request);
        $data['authorId'] = $user->id;
        $tag = Tag::firstOrCreate($data);
        return response()->json([
            'message' => 'Tag created!',
            'tag' => new TagResource($tag),
        ]);
    }
}
