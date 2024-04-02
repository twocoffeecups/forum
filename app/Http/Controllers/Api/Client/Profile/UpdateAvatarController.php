<?php

namespace App\Http\Controllers\Api\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Profile\AvatarRequest;
use App\Services\AuthService;
use App\Services\Client\Profile\ChangeAvatar;

class UpdateAvatarController extends Controller
{
    use ChangeAvatar;

    /** Change user avatar
     * @param AvatarRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(AvatarRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = AuthService::getAuthorizedUser($request);
        /** Change avatar */
        return $this->changeAvatar($user, $data)
            ? $this->avatarChangedResponse($user->getAvatar())
            : $this->failedToChangeAvatarResponse();
    }

    protected function avatarChangedResponse($avatarUrl)
    {
        return response()->json([
            'message'=>'New avatar saved.',
            'avatar' => $avatarUrl,
        ]);
    }

    protected function failedToChangeAvatarResponse()
    {
        return response()->json(['message'=>'New avatar saved.']);
    }
}
