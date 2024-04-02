<?php

namespace App\Http\Controllers\Api\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\AddUserPermissionsRequest;
use App\Models\Permission;
use App\Models\User;

class ChangePermissionController extends Controller
{
    /**
     * Change user's permissions
     * @param AddUserPermissionsRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(AddUserPermissionsRequest $request, User $user)
    {
        $data = $request->validated();
        $user->userPermissions()->sync($data['permissions']);
        $user->save();
        return response()->json(['message' => "The user's permissions has been successfully changed"]);
    }
}
