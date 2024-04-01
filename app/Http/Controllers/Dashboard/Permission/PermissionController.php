<?php

namespace App\Http\Controllers\Dashboard\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Requests\Dashboard\Permission\PermissionRequest;
use App\Http\Resources\Dashboard\Permission\PermissionResource;
use App\Http\Resources\Dashboard\Role\RolePermissionResource;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index(PaginateRequest $request)
    {
        $paginate = $request->validated();
        $permissions = Permission::paginate($paginate['entriesOnPage'], '*', 'page', $paginate['page']);
        return PermissionResource::collection($permissions);
    }

    public function getPermissionsForForm()
    {
        $permissions = Permission::all();
        return response()->json(['permissions' => RolePermissionResource::collection($permissions)]);
    }

    public function store(PermissionRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = 'can_' . str_replace(' ', '_', strtolower($data['name']));
        $permission = Permission::firstOrCreate($data);
        return response()->json([
            'message' => 'Permission created!',
            'permission' => new PermissionResource($permission),
        ]);
    }

    public function show(Permission $permission): object
    {
        return response()->json(['permission' => $permission]);
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $data = $request->validated();
        $data['slug'] =  "can_" . str_replace(' ', '_', strtolower($data['name']));
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
