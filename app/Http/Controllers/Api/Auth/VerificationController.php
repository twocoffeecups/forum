<?php
namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Profile\ResendMailRequest;
use App\Mail\Client\User\VerifyMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{

    public function verify($id, $hash)
    {
        $user = User::where('id', $id)->first();

        if(!$user){
            return response()->json(['message' => 'Invalid credentials.'], 404);
        }

        if(!hash_equals((string) $id, (string) $user->getKey())){
            return response()->json(['message' => 'Hash not equals.'], 403);
        }

        if(!hash_equals((string) $hash, sha1($user->getEmailForVerification()))){
            return response()->json(['message' => 'Hash not equals.'], 403);
        }

        if($user->hasVerifiedEmail()){
            return response()->json(['message' => 'Your email has already been confirmed.'], 201);
        }

        if($user->markEmailAsVerified()){
            return response()->json(['message' => 'Email address has been successfully confirmed.'], 200);
        }else{
            return response()->json(['message' => 'Error! Email don\'t confirmed.'], 403);
        }

    }

    public function resend(ResendMailRequest $request){
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        if($user && $user->hasVerifiedEmail()){
            return response()->json(['message'=>'Email already verified.'], 200);
        }

        if(Mail::to($user->getEmailForVerification())->send(new VerifyMail($user->getKey(), $user->login, sha1($user->getEmailForVerification())))){
            return response()->json(['message' => 'New email verification link send on your email address.'], 202);
        }

        return response()->json(['message' => 'Error! Failed to send email.'], 403);
    }

}
