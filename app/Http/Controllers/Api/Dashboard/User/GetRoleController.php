<?php

namespace App\Http\Controllers\Api\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Role\RoleResource;
use App\Models\Role;
use App\Models\User;

class GetRoleController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $roles = Role::all();
        return response()->json([
            'roles' => RoleResource::collection($roles),
        ]);
    }
}
