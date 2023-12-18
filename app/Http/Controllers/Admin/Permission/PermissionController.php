<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\PermissionRequest;
use App\Http\Resources\Admin\Permission\PermissionResource;
use App\Http\Resources\Admin\Role\RolePermissionResource;
use App\Models\Permission;

class PermissionController extends Controller
{

    public function index()
    {
        $permissions = Permission::all();
        return response()->json(['permissions' => PermissionResource::collection($permissions)]);
    }

    public function getPermissionsForForm()
    {
        $permissions = Permission::all();
        return response()->json(['permissions' => RolePermissionResource::collection($permissions)]);
    }

    public function store(PermissionRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = 'can-' . str_replace(' ', '-', strtolower($data['name']));
        $permission = Permission::firstOrCreate($data);
        return response()->json([
            'message' => 'Permission created!',
            'permission' => $permission,
        ]);
    }

    public function show(Permission $permission): object
    {
        return response()->json(['permission' => $permission]);
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $data = $request->validated();
        $data['slug'] =  "can-" . str_replace(' ', '-', strtolower($data['name']));
        foreach ($data as $key => $value) {
            $permission->$key = $value;
        }
        $permission->save();
        return response()->json([
            'message' => 'Permission updated!',
            'permission' => $permission,
        ]);
    }

    public function delete(Permission $permission)
    {
        if(count($permission->roles)!==0){
            return response()->json(['message' => 'This permission is linked to one of the roles. Remove it from the role permissions list'], 422);
        }
        $permission->delete();
        return response()->json(['message' => 'Permission deleted successfully!']);
    }

    public function status(Permission $permission)
    {
        $permission->status = !$permission->status;
        $permission->save();
        return response()->json(['message' => 'Permission status changed!']);
    }
}
