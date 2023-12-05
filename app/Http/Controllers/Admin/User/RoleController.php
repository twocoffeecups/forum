<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * @param User $user
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(User $user, Role $role): \Illuminate\Http\JsonResponse
    {
        $user->role()->associate($role);
        $user->save();
        return response()->json([
            'message' => "The user's role has been successfully changed",
        ]);
    }
}
