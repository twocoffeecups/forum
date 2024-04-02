<?php

namespace App\Http\Controllers\Api\Dashboard\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Dashboard\Topic\RejectedTopicResource;
use App\Models\RejectedTopic;

class GetRejectedTopicController extends Controller
{
    /**
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PaginateRequest $request)
    {
        $paginate = $request->validated();
        $topics = RejectedTopic::paginate($paginate['entriesOnPage'], '*', 'page', $paginate['page']);
        return RejectedTopicResource::collection($topics);
    }
}
