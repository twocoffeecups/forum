<?php

namespace App\Http\Controllers\Api\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\User\UserResource;
use App\Models\User;

class GetController extends Controller
{
    /**
     * Show user
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(User $user)
    {
        return response()->json(['user' => new UserResource($user)]);
    }
}
