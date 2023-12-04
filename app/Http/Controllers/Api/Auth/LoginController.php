<?php


namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Profile\LoginRequest;
use App\Http\Resources\Admin\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{

    public function __invoke(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        if(!$user){
            return response()->json(['message' => 'User not found!'], 404);
        }
        if(!Hash::check($data['password'], $user->password)){
            return response()->json(['message' => 'Wrong password.'], 422);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Login in!',
            'userDetails' => new UserResource($user),
            'accessToken' => $token,
        ]);
    }

}
