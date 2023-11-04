<?php


namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;

use App\Http\Requests\Api\Client\Account\RegisterRequest;
use App\Http\Resources\Admin\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class RegisterController extends Controller
{

    public function __invoke(RegisterRequest $request)
    {
        $data = $request->validated();

        //dd($data);
        $data['password'] = Hash::make($data['password']);
        $user = User::firstOrCreate(['login'=>$data['login']],$data);
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Registration successfully!',
            'userInfo' => new UserResource($user),
            'token' => $token,
        ]);
    }

}
