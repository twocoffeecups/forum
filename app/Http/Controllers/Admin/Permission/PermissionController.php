<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\PermissionRequest;
use App\Http\Resources\Admin\Role\RolePermissionResource;
use App\Models\Permission;

class PermissionController extends Controller
{

    public function index()
    {
        $permissions = Permission::all();
        return response()->json(['permissions' => RolePermissionResource::collection($permissions)]);
    }

    public function store(PermissionRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = str_replace(' ', '-', strtolower($data['name']));
        //dd($data);
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
        $data['slug'] = str_replace(' ', '-', strtolower($data['name']));
        //dd($data);
        foreach ($data as $key => $value){
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
