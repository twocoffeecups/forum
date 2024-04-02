<?php

namespace App\Http\Controllers\Api\Dashboard\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Dashboard\Forum\ForumResource;
use App\Models\Forum;

class IndexController extends Controller
{
    /**
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PaginateRequest $request)
    {
        $data = $request->validated();
        $forums = Forum::paginate($data['entriesOnPage'], ['*'], 'page', $data['page']);
        return ForumResource::collection($forums);
    }
}
