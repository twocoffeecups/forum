<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\TagStoreRequest;
use App\Http\Requests\Admin\Tag\TagUpdateRequest;
use App\Http\Resources\Admin\Forum\TagResource;
use App\Models\Tag;

class TagController extends Controller
{

    public function index()
    {
        $tags = TagResource::collection(Tag::all());
        return response()->json(['tags' => TagResource::collection($tags)]);
    }

    public function store(TagStoreRequest $request)
    {
        $data = $request->validated();
        //dd($data);
        $tag = Tag::firstOrCreate($data);
        return response()->json([
            'message' => 'Tag created!',
            'tag' => new TagResource($tag),
        ]);
    }

    public function show(Tag $tag)
    {
        return response()->json(['tag' => new TagResource($tag)]);
    }

    public function update(TagUpdateRequest $request, Tag $tag)
    {
        $data = $request->validated();
        foreach($data as $key => $value){
            $tag->$key = $value;
        }
        $tag->save();
        return response()->json(['message' => 'Tag updated!']);
    }

    public function delete(Tag $tag)
    {
        $tag->delete();
        return response()->json(['message' => 'Tag deleted successfully!']);
    }

    public function status(Tag $tag)
    {
        $tag->status = !$tag->status;
        $tag->save();
        return response()->json(['message' => 'Tag status changed.']);
    }
}
