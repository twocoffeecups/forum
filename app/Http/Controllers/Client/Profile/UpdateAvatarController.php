<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Profile\AvatarRequest;
use App\Services\AuthService;
use App\Services\Client\Profile\ChangeAvatar;

class UpdateAvatarController extends Controller
{
    use ChangeAvatar;
    public function __invoke(AvatarRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = AuthService::getAuthorizedUser($request);
        /** Change avatar */
        return $this->changeAvatar($user, $data)
            ? $this->avatarChangedResponse()
            : $this->failedToChangeAvatarResponse();
    }

    protected function avatarChangedResponse()
    {
        return response()->json(['message'=>'New avatar saved.']);
    }

    protected function failedToChangeAvatarResponse()
    {
        return response()->json(['message'=>'New avatar saved.']);
    }
}
