<?php

namespace App\Http\Controllers\Api\Dashboard\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Role\RoleRequest;
use App\Http\Resources\Dashboard\Role\RoleResource;
use App\Models\Role;

class StoreController extends Controller
{
    /**
     * @param RoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RoleRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $data['slug'] = str_replace(' ', '-', strtolower($data['name']));
        $permissions = $data['permissions']; unset($data['permissions']);
        $role = Role::firstOrCreate($data);
        $role->permissions()->attach($permissions);
        return response()->json([
            'message' => 'Role created!',
            'role' => new RoleResource($role),
        ]);
    }
}
