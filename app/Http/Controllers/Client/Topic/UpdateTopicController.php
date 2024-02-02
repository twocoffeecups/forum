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
use App\Services\Topic\UpdateTopic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateTopicController extends Controller
{
    use UpdateTopic;

    /**
     * @param TopicUpdateRequest $request
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TopicUpdateRequest $request, Topic $topic): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        /** Update topic */
        $topic = $this->updateTopic($topic, $data);
        return $topic
            ? $this->topicUpdatedSuccessfullyResponse($topic)
            : $this->failedToUpdateTopicResponse();
    }

}
