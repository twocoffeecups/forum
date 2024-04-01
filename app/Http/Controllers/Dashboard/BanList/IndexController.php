<?php

namespace App\Http\Controllers\Dashboard\BanList;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Models\BanList;

class IndexController extends Controller
{

    public function __invoke(PaginateRequest $request)
    {
        $paginate = $request->validated();
        $users = BanList::paginate($paginate['entriesOnPage'], ['*'], 'page', $paginate['page']);
        return BanListResource::collection($users);return view('dashboard.main.index');
    }
}
