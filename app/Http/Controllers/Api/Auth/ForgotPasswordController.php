<?php


namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Account\ForgotPasswordRequest;
use App\Mail\Client\User\ResetPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{

    public function __invoke(ForgotPasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        if(!$user){
            return response()->json(['message' => 'User not found'], 404);
        }

        // create reset code and add in password_resets table
        $code= Str::random(10);
        $userPasswordReset = PasswordReset::where('email', $user->email)->first();

        if(!$userPasswordReset){
            PasswordReset::create([
                'email' => $user->email,
                'token' => sha1($code),
            ]);
        }else{
            $userPasswordReset->token = sha1($code);
            $userPasswordReset->save();
        }

        // send code
        if(!Mail::to($user->email)->send(new ResetPasswordMail($user->login, sha1($code)))){
            return response()->json(['message' => 'Error! Failed to send password reset code.']);
        }

        return response()->json(['message' => 'The code has been sent to the specified email.']);
    }

}
