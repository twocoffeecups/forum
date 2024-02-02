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
use App\Notifications\TopicLiked;
use App\Services\AuthService;
use App\Services\Topic\CreateTopic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreTopicController extends Controller
{
    use CreateTopic;

    /**
     * @param TopicStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TopicStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = AuthService::getAuthorizedUser($request);
        if($user->isBanned()){
            AuthService::checkEndOfBan($user);
        }
        $topic = $this->createTopic($user, $data);
        DB::commit();
        return response()->json([
            'message' => 'Topic created',
            'topicId' => $topic->id,
            'topic' => new TopicResource($topic),
        ]);
    }
}
