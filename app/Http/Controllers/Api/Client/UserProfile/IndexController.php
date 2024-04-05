<?php

namespace App\Http\Controllers\Api\Client\UserProfile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\UserProfile\UserProfileResource;
use App\Models\User;

class IndexController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(User $user): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'userDetails' => new UserProfileResource($user),
        ]);
    }
}
