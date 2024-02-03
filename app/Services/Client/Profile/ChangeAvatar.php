<?php

namespace App\Services\Client\Profile;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

trait ChangeAvatar
{
    protected function changeAvatar(User $user, $data)
    {
        $this->isAvatarExists($user);
        $avatarPath = $this->saveAvatar($data['avatar']);
        if(!$avatarPath) return false;
        return $this->store($user, $avatarPath);
    }

    protected function store(User $user, $avatar)
    {
        $user->avatarPath = $avatar;
        $user->avatarUrl = url('/storage/' . $avatar);
        return $user->save();
    }

    protected function isAvatarExists(User $user)
    {
        if($user->getAvatar() !== false && Storage::disk('public')->exists($user->avatarPath)){
            Storage::disk('public')->delete($user->avatarPath);
        }
    }

    protected function saveAvatar($avatar)
    {
        $avatarName = md5(Carbon::now() . '_' . $avatar->getClientOriginalName()) . '.' . $avatar->getClientOriginalExtension();
        return Storage::disk('public')->putFileAs('/users/avatars', $avatar, $avatarName);
    }

}
