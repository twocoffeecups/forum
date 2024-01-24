<?php


namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Profile\RegisterRequest;
use App\Http\Resources\Client\Profile\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{

    public function __invoke(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::firstOrCreate(['login'=>$data['login']],$data);
        $userRole = Role::where('slug', '=', 'user')->first();
        $user->role()->associate($userRole);
        $user->save();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Registration successfully!',
            'userInfo' => new UserResource($user),
            'token' => $token,
        ]);
    }

}
