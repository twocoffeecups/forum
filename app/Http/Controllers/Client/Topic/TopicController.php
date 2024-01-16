<?php

namespace App\Http\Controllers\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Topic\TopicStoreRequest;
use App\Http\Requests\Api\Client\Topic\TopicUpdateRequest;
use App\Http\Resources\Client\Topic\TopicEditResource;
use App\Http\Resources\Client\Topic\TopicForumTreeResource;
use App\Http\Resources\Client\Topic\TopicResource;
use App\Http\Resources\Client\Topic\TopicTagFormResource;
use App\Libraries\TreeBuilder;
use App\Models\Forum;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\TopicImage;
use App\Models\User;
use App\Services\AuthService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TopicController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $topics = Topic::allApprovedTopics();
        return response()->json(['topics' => TopicResource::collection($topics)]);
    }

    /**
     * @param TopicStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function store(TopicStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = AuthService::getUserByToken($request);
        if($user->isBanned()){
            AuthService::checkEndOfBan($user);
        }
        $data['userId'] = $user->id;
        if (!empty($data['images'])) {
            $images = $data['images'];
            unset($data['images']);
        }
        if (!empty($data['tags'])) {
            $tags = $data['tags'];
            unset($data['tags']);
        }
        /** DB transaction
         * TODO: перенести в Service
         */
        DB::beginTransaction();
        $topic = Topic::create($data);
        if (!empty($tags)) {
            $topic->tags()->toggle($tags);
        }
        // images
        if (!empty($images)) {
            foreach ($images as $image) {
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

    /**
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function show(Request $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        // TODO: сделать доступ только автору и админу/модератору
        if ($topic->status === 0) {
            return response()->json(['message' => "Topic not found"], 404);
        }
        return response()->json(['topic' => new TopicResource($topic)]);
    }

    /**
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function edit(Request $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
//        if($topic->status===0){
//            return response()->json(['message' => "Topic not found"], 404);
//        }
        return response()->json(['topic' => new TopicEditResource($topic)]);
    }

    /**
     * @param TopicUpdateRequest $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function update(TopicUpdateRequest $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $images = $data['images'] ?? null;
        $tags = $data['tags'] ?? null;
        $imagesForDelete = $data['imagesForDelete'] ?? null;
        unset($data['images'], $data['tags'], $data['imagesForDelete']);
        /** DB transaction
         * TODO: перенести в Service, переделать загрузку изображений
         */
        DB::beginTransaction();
        foreach ($data as $key => $value) {
            $topic->$key = $value;
        }
        $topic->save();
        if (!empty($tags)) {
            $topic->tags()->toggle($tags);
        }else {
            $topic->tags()->detach();
        }
        // delete old images
        if (!empty($topic->images) && !empty($imagesForDelete)) {
            foreach ($topic->images as $image){
                if(in_array($image->id, $imagesForDelete)){
                    Storage::disk('public')->delete($image->imagePath);
                    $image->delete();
                }
            }
        }
        // save new images
        if (!empty($images)) {
            foreach ($images as $image) {
                $imageName = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
                $imagePath = Storage::disk('public')->putFileAs('/topics/images', $image, $imageName);
                TopicImage::create([
                    'topicId' => $topic->id,
                    'userId' => $topic->userId,
                    'imagePath' => $imagePath,
                    'imageUrl' => url('/storage/' . $imagePath),
                ]);
            }
        }
        DB::commit();
        return response()->json([
            'message' => 'Topic updated.',
            'topic' => new TopicResource($topic),
        ]);
    }

    /**
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function delete(Topic $topic): \Illuminate\Http\JsonResponse
    {
        if ($topic->posts != 0) {
            return response()->json(['message' => "You can't delete a topic because there are posts for it"], 406);
        }
        $topic->delete();
        return response()->json(['message' => 'Topic deleted.']);
    }

    /**
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function like(Request $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getUserByToken($request);
        $topic->likes()->toggle($user->id);
        return response()->json(['message' => 'Change topic like.']);
    }

    /**
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function addToBookmarks(Request $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getUserByToken($request);
        $user->topicBookmarks()->toggle($topic->id);
        //$topic->bookmarks()->toggle($user->id);
        return response()->json(['message' => 'Change topic bookmarks.']);
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
     * TODO: переделать getter на фронте и удалить этот метод
     */
    public function topicTags(): \Illuminate\Http\JsonResponse
    {
        $tags = Tag::all();
        return response()->json([
            'tags' => TopicTagFormResource::collection($tags),
        ]);
    }

}
