<?php

namespace App\Http\Controllers\Api\Dashboard\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Dashboard\Role\RoleResource;
use App\Models\Role;

class IndexController extends Controller
{
    /**
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PaginateRequest $request)
    {
        $paginate = $request->validated();
        $roles = Role::paginate($paginate['entriesOnPage'], '*', 'page', $paginate['page']);
        return RoleResource::collection($roles);
    }
}
