<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Http\Resources\Admin\Forum\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index(){
        $tags = TagResource::collection(Tag::all());
        return response()->json(['tags' => $tags]);
    }

    public function store(TagRequest $request){
        $data = $request->validated();
        $tag = Tag::firstOrCreate($data);
        return response()->json(['message' => 'Tag created!']);
    }

    public function show(Tag $tag){
        return response()->json(['category' => new TagResource($tag)]);
    }

    public function update(TagRequest $request, Tag $tag){
        $data = $request->validated();
        $tag->name = $data['name'];
        $tag->description = $data['description'];
        $tag->save();
        return response()->json(['message' => 'Tag updated!']);
    }

    public function delete(Tag $tag){
        $tag->delete();
        return response()->json(['message' => 'Tag deleted successfully!']);
    }
}
