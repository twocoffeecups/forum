<?php

namespace App\Http\Controllers\Api\Dashboard\BanList;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Dashboard\BanList\BanListResource;
use App\Models\BanList;

class IndexController extends Controller
{

    public function __invoke(PaginateRequest $request)
    {
        $paginate = $request->validated();
        $users = BanList::paginate($paginate['entriesOnPage'], ['*'], 'page', $paginate['page']);
        return BanListResource::collection($users);
    }
}
