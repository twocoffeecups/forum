<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\AvatarRequest;
use App\Http\Resources\Dashboard\User\UserResource;
use App\Models\User;
use App\Services\Client\Profile\ChangeAvatar;

class ChangeAvatarController extends Controller
{
    use ChangeAvatar;
    public function __invoke(AvatarRequest $request, User $user)
    {
        $avatar = $request->validated();
        //dd($avatar, $user);
        /** Change avatar */
        return $this->changeAvatar($user, $avatar)
            ? $this->avatarChangedResponse($user)
            : $this->failedToChangeAvatarResponse();
    }

    protected function avatarChangedResponse(User $user)
    {
        return response()->json([
            'message'=>'User\'s avatar updated!',
            'user' => new UserResource($user),
        ]);
    }

    protected function failedToChangeAvatarResponse()
    {
        return response()->json(['message'=>'User\' avatar don\'t saved.']);
    }
}
