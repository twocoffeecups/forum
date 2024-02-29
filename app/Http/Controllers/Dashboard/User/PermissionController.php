<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\AddUserPermissionsRequest;
use App\Models\Permission;
use App\Models\User;

class PermissionController extends Controller
{
    public function changePermission(AddUserPermissionsRequest $request, User $user)
    {
        $data = $request->validated();
        $user->userPermissions()->sync($data['permissions']);
        $user->save();
        return response()->json(['message' => "The user's permissions has been successfully changed"]);
    }
}
