<?php

namespace App\Http\Controllers\Api\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Profile\UpdateProfileRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

class UpdateProfileController extends Controller
{
    /**
     * Update user profile
     * @param User $user
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(UpdateProfileRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = AuthService::getAuthorizedUser($request);
        $user->fill($data);
        $user->save();
        return response()->json(['message' => 'You profile updated!']);
    }
}
