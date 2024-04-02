<?php

namespace App\Http\Controllers\Api\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\UpdateProfileRequest;
use App\Http\Resources\Dashboard\User\UserResource;
use App\Models\User;

class UpdateProfileController extends Controller
{
    public function __invoke(UpdateProfileRequest $request, User $user)
    {
        $data = $request->validated();
        $user->fill($data);
        $user->save();
        return response()->json([
            'message' => 'User\'s profile updated!',
            'user' => new UserResource($user),
        ]);
    }
}
