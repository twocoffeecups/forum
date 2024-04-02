<?php

namespace App\Http\Controllers\Api\Dashboard\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Dashboard\Forum\TagResource;
use App\Models\Tag;

class IndexController extends Controller
{

    /**
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PaginateRequest $request)
    {
        $paginate = $request->validated();
        $tags = Tag::paginate($paginate['entriesOnPage'], ['*'], 'page', $paginate['page']);
        return TagResource::collection($tags);
    }
}
