<?php

namespace App\Http\Controllers\Api\Dashboard\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission;

class ChangeStatusController extends Controller
{
    /**
     * Change permission status
     * @param Permission $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Permission $permission)
    {
        $permission->status = !$permission->status;
        $permission->save();
        return response()->json(['message' => 'Permission status changed!']);
    }
}
