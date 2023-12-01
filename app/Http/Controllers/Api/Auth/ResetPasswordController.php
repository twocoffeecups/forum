<?php


namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Profile\PasswordResetRequest;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{

    public function __invoke(PasswordResetRequest $request)
    {
        $data = $request->validated();

        dd($data);

        $passwordReset = PasswordReset::where('email', $data['email'])->first();
        $user = User::where('email', $data['email'])->first();

        if(!$user){
            return response()->json(['message' => 'User not found.'], 404);
        }

//        if(!$passwordReset || !Hash::check($data['token'], $passwordReset->token)){
//            return response()->json(['message' => 'Invalid credentials.']);
//        }
        if(!$passwordReset || !hash_equals((string) $data['hash'], (string) $passwordReset->token)){
            return response()->json(['message' => 'Invalid credentials.']);
        }

        // new password
        $user->password = Hash::make($data['password']);

        if($user->save()){
            $passwordReset->delete();
            return response()->json(['message' => 'New password created! Login in.']);
        }

        return response()->json(['message' => 'Error! Failed to change password. Try again later.']);

    }

}
