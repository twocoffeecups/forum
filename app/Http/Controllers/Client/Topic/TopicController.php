<?php

namespace App\Http\Controllers\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Topic\TopicStoreRequest;
use App\Http\Requests\Api\Client\Topic\TopicUpdateRequest;
use App\Http\Resources\Client\Topic\TopicForumTreeResource;
use App\Http\Resources\Client\Topic\TopicResource;
use App\Http\Resources\Client\Topic\TopicTagFormResource;
use App\Libraries\TreeBuilder;
use App\Models\Forum;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\TopicImage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
{

    public function index()
    {
        return response()->json(['topics' => TopicResource::collection(Topic::all())]);
    }

    /**
     * @param TopicStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function store(TopicStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = $this->getUserByToken($request);
        $data['userId'] = $user->id;
        if (!empty($data['images'])){
            $images = $data['images']; unset($data['images']);
        }
        if (!empty($data['tags'])){
            $tags = $data['tags']; unset($data['tags']);
        }
        /** DB transaction
         * TODO: перенести в Service
         */
        DB::beginTransaction();
        $topic = Topic::create($data);
        if(!empty($tags)) {
            $topic->tags()->toggle($tags);
        }
        // images
        if(!empty($images)){
            foreach ($images as $image){
                $imageName = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
                $imagePath = Storage::disk('public')->putFileAs('/topics/images', $image, $imageName);
                TopicImage::create([
                    'topicId' => $topic->id,
                    'userId' => $user->id,
                    'imagePath' => $imagePath,
                    'imageUrl' => url('/storage/' . $imagePath),
                ]);
            }
        }
        DB::commit();
        return response()->json([
            'message' => 'Topic created',
            'topicId' => $topic->id,
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function createFormResources(): \Illuminate\Http\JsonResponse
    {
        $forums = TreeBuilder::getTree(Forum::all());
        $tags = Tag::all();
        return response()->json([
            'forums' => TopicForumTreeResource::collection($forums),
            'tags' => TopicTagFormResource::collection($tags),
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * TODO: переделать getter на фронте и удалить метод
     */
    public function topicTags(): \Illuminate\Http\JsonResponse
    {
        $tags = Tag::all();
        return response()->json([
            'tags' => TopicTagFormResource::collection($tags),
        ]);
    }

}
