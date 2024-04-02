<?php

namespace App\Http\Controllers\Api\Dashboard\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Role\RoleEditNameRequest;
use App\Models\Role;

class UpdateController extends Controller
{
    /**
     * @param RoleEditNameRequest $request
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RoleEditNameRequest $request, Role $role): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $data['slug'] = str_replace(' ', '_', strtolower($data['name']));
        $role->fill($data);
        $role->save();
        return response()->json(['message' => 'Role updated!']);
    }
}
