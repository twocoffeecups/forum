<?php

namespace App\Http\Controllers\Api\Dashboard\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Permission\PermissionRequest;
use App\Models\Permission;

class UpdateController extends Controller
{
    /**
     * @param PermissionRequest $request
     * @param Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(PermissionRequest $request, Permission $permission)
    {
        $data = $request->validated();
        $data['slug'] =  "can_" . str_replace(' ', '_', strtolower($data['name']));
        $permission->fill($data);
        $permission->save();
        return response()->json([
            'message' => 'Permission updated!',
            'permission' => $permission,
        ]);
    }
}
