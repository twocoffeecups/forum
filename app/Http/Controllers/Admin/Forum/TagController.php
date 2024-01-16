<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\TagStoreRequest;
use App\Http\Requests\Admin\Tag\TagUpdateRequest;
use App\Http\Resources\Admin\Forum\TagResource;
use App\Models\Tag;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class TagController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $tags = Tag::all();
        return response()->json(['tags' => TagResource::collection($tags)]);
    }

    /**
     * @param TagStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TagStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = AuthService::getUserByToken($request);
        $data['authorId'] = $user->id;
        $tag = Tag::firstOrCreate($data);
        return response()->json([
            'message' => 'Tag created!',
            'tag' => new TagResource($tag),
        ]);
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Tag $tag): \Illuminate\Http\JsonResponse
    {
        return response()->json(['tag' => new TagResource($tag)]);
    }

    public function update(TagUpdateRequest $request, Tag $tag)
    {
        $data = $request->validated();
        //dd($data);
        foreach($data as $key => $value){
            $tag->$key = $value;
        }
        $tag->save();
        return response()->json(['message' => 'Tag updated!']);
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Tag $tag): \Illuminate\Http\JsonResponse
    {
        $tag->delete();
        return response()->json(['message' => 'Tag deleted successfully!']);
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     * Change tag status(visiblity)
     */
    public function status(Tag $tag): \Illuminate\Http\JsonResponse
    {
        $tag->status = !$tag->status;
        $tag->save();
        return response()->json(['message' => 'Tag status changed.']);
    }
}
