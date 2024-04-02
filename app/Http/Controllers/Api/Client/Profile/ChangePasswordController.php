<?php

namespace App\Http\Controllers\Api\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Profile\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Change usere password
     * @param User $user
     * @param UpdatePasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(User $user, UpdatePasswordRequest $request): \Illuminate\Http\JsonResponse
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
