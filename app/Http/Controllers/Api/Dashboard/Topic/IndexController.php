<?php

namespace App\Http\Controllers\Api\Dashboard\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Dashboard\Topic\TopicResource;
use App\Models\Topic;

class IndexController extends Controller
{
    /**
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PaginateRequest $request)
    {
        $paginate = $request->validated();
        $topics = Topic::paginate($paginate['entriesOnPage'], '*', 'page', $paginate['page']);
        return TopicResource::collection($topics);
    }
}
