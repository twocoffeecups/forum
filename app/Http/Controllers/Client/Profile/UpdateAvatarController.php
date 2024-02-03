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
use App\Services\Client\Profile\ChangeAvatar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
