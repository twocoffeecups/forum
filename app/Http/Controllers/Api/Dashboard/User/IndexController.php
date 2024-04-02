<?php

namespace App\Http\Controllers\Api\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Dashboard\User\UserResource;
use App\Models\User;

class IndexController extends Controller
{
    /**
     * Get all users
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PaginateRequest $request)
    {
        $paginate = $request->validated();
        $users = User::paginate($paginate['entriesOnPage'], ['*'], 'page', $paginate['page']);
        return UserResource::collection($users);
    }
}
