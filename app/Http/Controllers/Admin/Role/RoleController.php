<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleEditNameRequest;
use App\Http\Requests\Admin\Role\RoleRequest;
use App\Http\Requests\Admin\Role\RoleUpdatePermissionsRequest;
use App\Http\Resources\Admin\Role\RoleResource;
use App\Models\Role;

class RoleController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['roles' => RoleResource::collection(Role::all())]);
    }

    /**
     * @param RoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $data['slug'] = str_replace(' ', '-', strtolower($data['name']));
        $permissions = $data['permissions']; unset($data['permissions']);
        $role = Role::firstOrCreate($data);
        $role->permissions()->attach($permissions);
        return response()->json(['message' => 'Role created!']);
    }

    /**
     * @param Role $role
     * @return object|\Illuminate\Http\JsonResponse
     */
    public function show(Role $role): object
    {
        return response()->json(['role' => new RoleResource($role)]);
    }

    /**
     * @param RoleEditNameRequest $request
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoleEditNameRequest $request, Role $role): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $data['slug'] = str_replace(' ', '_', strtolower($data['name']));
        foreach ($data as $key => $value){
            $role->$key = $value;
        }
        $role->save();
        return response()->json(['message' => 'Role updated!']);
    }

    /**
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Role $role): \Illuminate\Http\JsonResponse
    {
        if($role->users->count()){
            return response()->json(['message' => 'You cannot delete this role because there are users associated with it. Assign users a different role.']);
        }
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully!']);
    }

    /**
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Role $role): \Illuminate\Http\JsonResponse
    {
        $role->status = !$role->status;
        $role->save();
        return response()->json(['message' => 'Role status changed!']);
    }

    /**
     * @param RoleUpdatePermissionsRequest $request
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePermissions(RoleUpdatePermissionsRequest $request, Role $role): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $role->permissions()->sync($data['permissions']);
        $role->save();
        return response()->json(['message' => 'Role permission change successfully!']);
    }
}
