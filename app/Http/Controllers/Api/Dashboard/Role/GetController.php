<?php

namespace App\Http\Controllers\Api\Dashboard\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Role\RoleResource;
use App\Models\Role;

class GetController extends Controller
{
    /**
     * @param Role $role
     * @return object|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Role $role): object
    {
        return response()->json(['role' => new RoleResource($role)]);
    }
}
