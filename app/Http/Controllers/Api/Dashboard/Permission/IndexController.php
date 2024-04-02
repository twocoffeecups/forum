<?php

namespace App\Http\Controllers\Api\Dashboard\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Dashboard\Permission\PermissionResource;
use App\Models\Permission;

class IndexController extends Controller
{
    /**
     * Get all permissions
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PaginateRequest $request)
    {
        $paginate = $request->validated();
        $permissions = Permission::paginate($paginate['entriesOnPage'], '*', 'page', $paginate['page']);
        return PermissionResource::collection($permissions);
    }
}
