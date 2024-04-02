<?php

namespace App\Http\Controllers\Api\Dashboard\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;

class ChangeStatusController extends Controller
{
    /**
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Role $role): \Illuminate\Http\JsonResponse
    {
        $role->status = !$role->status;
        $role->save();
        return response()->json(['message' => 'Role status changed!']);
    }
}
