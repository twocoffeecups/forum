<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Profile\AvatarRequest;
use App\Http\Requests\Api\Client\Profile\UpdatePasswordRequest;
use App\Http\Requests\Api\Client\Profile\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected function update(User $user, UpdateProfileRequest $request)
    {
        $data = $request->validated();
        dd($data);
        foreach ($data as $key => $value){
            $user->$key = $value;
        }
        $user->save();
        return response()->json(['message' => 'You profile updated!']);
    }

    protected function updatePassword(User $user, UpdatePasswordRequest $request)
    {
        $data = $request->validated();
        dd($data);
        if(!Hash::check($user->password, $data['oldPassword'])){
            return response()->json(['message' => 'You entered the wrong password.'], 422);
        }
        $user->password = Hash::make($data['password']);
        $user->save();
        return response()->json(['message' => 'You password updated!']);
    }

    protected function updateAvatar(User $user, AvatarRequest $request)
    {
        $data = $request->validated();
        dd($data);
    }

}
