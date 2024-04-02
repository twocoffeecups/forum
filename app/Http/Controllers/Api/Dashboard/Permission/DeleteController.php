<?php

namespace App\Http\Controllers\Api\Dashboard\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission;

class DeleteController extends Controller
{
    /**
     * @param Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Permission $permission)
    {
        if(count($permission->roles)!==0){
            return response()->json(['message' => 'This permission is linked to one of the roles. Remove it from the role permissions list'], 422);
        }
        $permission->delete();
        return response()->json(['message' => 'Permission deleted successfully!']);
    }
}
