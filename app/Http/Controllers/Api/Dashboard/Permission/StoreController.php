<?php

namespace App\Http\Controllers\Api\Dashboard\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Permission\PermissionRequest;
use App\Http\Resources\Dashboard\Permission\PermissionResource;
use App\Models\Permission;

class StoreController extends Controller
{
    /**
     * @param PermissionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(PermissionRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = 'can_' . str_replace(' ', '_', strtolower($data['name']));
        $permission = Permission::firstOrCreate($data);
        return response()->json([
            'message' => 'Permission created!',
            'permission' => new PermissionResource($permission),
        ]);
    }
}
