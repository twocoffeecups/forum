<?php

namespace App\Http\Controllers\Api\Dashboard\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Role\RoleUpdatePermissionsRequest;
use App\Models\Role;

class ChangePermissionsController extends Controller
{
    /**
     * @param RoleUpdatePermissionsRequest $request
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RoleUpdatePermissionsRequest $request, Role $role): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $role->permissions()->sync($data['permissions']);
        $role->save();
        return response()->json(['message' => 'Role permission change successfully!']);
    }
}
