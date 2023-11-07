<?php

namespace App\Http\Controllers\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Topic\TopicStoreRequest;
use App\Http\Requests\Api\Client\Topic\TopicUpdateRequest;
use App\Http\Resources\Client\Topic\TopicResource;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class TopicController extends Controller
{

    public function index()
    {
        return response()->json(['topics' => TopicResource::collection(Topic::all())]);
    }

    protected function store(TopicStoreRequest $request)
    {
        $data = $request->validated();
        $topic = Topic::create($data);
        return response()->json([
            'message' => 'Topic created',
            'topic' => new TopicResource($topic),
        ]);
    }

    protected function show(Topic $topic)
    {
        return response()->json(['topic' => new TopicResource($topic)]);
    }

    protected function update(TopicUpdateRequest $request, Topic $topic)
    {
        $data = $request->validated();
        foreach($data as $key => $value){
            $topic->$key = $value;
        }
        $topic->save();
        return response()->json(['message' => 'Topic updated.']);
    }

    protected function delete(Topic $topic)
    {
        if($topic->posts != 0){
            return response()->json(['message' => "You can't delete a topic because there are posts for it"], 406);
        }
        $topic->delete();
        return response()->json(['message' => 'Topic deleted.']);
    }

    protected function like(Topic $topic, User $user)
    {
        //dd($topic->likes);
        $topic->likes()->toggle($user->id);
        return response()->json(['message' => 'Change topic like.']);
    }

}
