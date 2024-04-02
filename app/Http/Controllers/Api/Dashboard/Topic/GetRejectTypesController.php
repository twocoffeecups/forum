<?php

namespace App\Http\Controllers\Api\Dashboard\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Requests\Dashboard\Topic\RejectTopicRequest;
use App\Http\Requests\Dashboard\Topic\StoreTopicRequest;
use App\Http\Requests\Dashboard\Topic\TopicDeleteRequest;
use App\Http\Resources\Dashboard\Topic\RejectedTopicResource;
use App\Http\Resources\Dashboard\Topic\TopicDetailsResource;
use App\Http\Resources\Dashboard\Topic\TopicResource;
use App\Http\Resources\Dashboard\TopicRejectType\TopicRejectTypeResource;
use App\Models\Topic;
use App\Models\RejectedTopic;
use App\Models\TopicRejectType;
use App\Notifications\TopicRejected;
use App\Services\AuthService;
use App\Services\Forum\Topic\CreateTopic;

class GetRejectTypesController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $rejectTypes = TopicRejectType::all();
        return response()->json(['rejectTypes' => TopicRejectTypeResource::collection($rejectTypes)]);
    }
}
