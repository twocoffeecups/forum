<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleRequest;
use App\Http\Resources\Admin\Role\RoleResource;
use App\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        return response()->json(['roles' => RoleResource::collection(Role::all())]);
    }

    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = str_replace(' ', '-', strtolower($data['name']));
        $role = Role::firstOrCreate($data);
        return response()->json(['message' => 'Role created!']);
    }

    public function show(Role $role): object
    {
        return response()->json(['role' => new RoleResource($role)]);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $data = $request->validated();
        $data['slug'] = str_replace(' ', '-', strtolower($data['name']));
        foreach ($data as $key => $value){
            $role->$key = $value;
        }
        $role->save();
        return response()->json(['message' => 'Role updated!']);
    }

    public function delete(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully!']);
    }

    public function status(Role $role)
    {
        $role->status = !$role->status;
        $role->save();
        return response()->json(['message' => 'Role status changed!']);
    }
}