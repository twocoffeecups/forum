<?php

namespace App\Http\Controllers\Api\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\Profile\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class GetController extends Controller
{
    /**
     * Get user profile
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getAuthorizedUser($request);
        if($user->isBanned()){
            AuthService::checkEndOfBan($user);
        }
        return response()->json([
            'userDetails' => new UserResource($user),
        ]);
    }
}
