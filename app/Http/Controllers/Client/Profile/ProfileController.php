<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Profile\AvatarRequest;
use App\Http\Requests\Api\Client\Profile\UpdatePasswordRequest;
use App\Http\Requests\Api\Client\Profile\UpdateProfileRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected function update(User $user, UpdateProfileRequest $request)
    {
        $data = $request->validated();
        foreach ($data as $key => $value){
            $user->$key = $value;
        }
        $user->save();
        return response()->json(['message' => 'You profile updated!']);
    }

    protected function updatePassword(User $user, UpdatePasswordRequest $request)
    {
        $data = $request->validated();
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
        // if user avatar exists
        if($user->avatar !== null){
            if(Storage::disk('public')->exists($user->avatar)){
                Storage::disk('public')->delete($user->avatar);
            }
        }
        // new avatar
        $avatarName = md5(Carbon::now() . '_' . $data['avatar']->getClientOriginalName()) . '.' . $data['avatar']->getClientOriginalExtension();
        $avatarPath = Storage::disk('public')->putFileAs('/users/avatars', $data['avatar'], $avatarName);

        $user->avatar = $avatarPath;
        $user->save();

        return response()->json(['message'=>'New avatar saved.']);
    }

}
