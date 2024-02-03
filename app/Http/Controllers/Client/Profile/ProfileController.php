<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Profile\AvatarRequest;
use App\Http\Requests\Api\Client\Profile\UpdatePasswordRequest;
use App\Http\Requests\Api\Client\Profile\UpdateProfileRequest;
use App\Http\Resources\Client\Profile\UserPermissionsResource;
use App\Http\Resources\Client\Profile\UserResource;
use App\Models\User;
use App\Services\AuthService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = AuthService::getAuthorizedUser($request);
        if($user->isBanned()){
            AuthService::checkEndOfBan($user);
        }
        return response()->json([
            'userDetails' => new UserResource($user),
        ]);
    }

    /**
     * @param User $user
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function update(User $user, UpdateProfileRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        foreach ($data as $key => $value){
            $user->$key = $value;
        }
        $user->save();
        return response()->json(['message' => 'You profile updated!']);
    }

    /**
     * @param User $user
     * @param UpdatePasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function updatePassword(User $user, UpdatePasswordRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        if(!Hash::check($user->password, $data['oldPassword'])){
            return response()->json(['message' => 'You entered the wrong password.'], 422);
        }
        $user->password = Hash::make($data['password']);
        $user->save();
        return response()->json(['message' => 'You password updated!'], 200);
    }
}
