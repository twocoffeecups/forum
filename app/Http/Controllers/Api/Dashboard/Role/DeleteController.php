<?php

namespace App\Http\Controllers\Api\Dashboard\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;

class DeleteController extends Controller
{
    /**
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Role $role): \Illuminate\Http\JsonResponse
    {
        if($role->users->count()){
            return response()->json(['message' => 'You cannot delete this role because there are users associated with it. Assign users a different role.']);
        }
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully!']);
    }
}
