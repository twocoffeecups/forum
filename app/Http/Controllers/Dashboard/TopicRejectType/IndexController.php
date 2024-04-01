<?php

namespace App\Http\Controllers\Dashboard\TopicRejectType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Dashboard\TopicRejectType\TopicRejectTypeResource;
use App\Models\TopicRejectType;

class IndexController extends Controller
{
    /**
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PaginateRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $paginate = $request->validated();
        $rejectTypes = TopicRejectType::paginate($paginate['entriesOnPage'], '*', 'page', $paginate['page']);
        return TopicRejectTypeResource::collection($rejectTypes);
    }
}
