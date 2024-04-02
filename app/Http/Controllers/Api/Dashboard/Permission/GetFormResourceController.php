<?php

namespace App\Http\Controllers\Api\Dashboard\Permission;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Role\RolePermissionResource;
use App\Models\Permission;

class GetFormResourceController extends Controller
{
    /**
     * Get permission's resource for form
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        $permissions = Permission::all();
        return response()->json(['permissions' => RolePermissionResource::collection($permissions)]);
    }
}
