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
            return redirect('/');
        }

        if(!hash_equals((string) $id, (string) $user->getKey())){
            return redirect('/');
        }

        if(!hash_equals((string) $hash, sha1($user->getEmailForVerification()))){
            return redirect('/');
        }

        if($user->hasVerifiedEmail()){
            return redirect('/');
        }

        if($user->markEmailAsVerified()){
            return redirect('/profile')->with('message', 'Email address has been successfully confirmed!');
        }else{
            return redirect('/profile')->with('message', 'Error! Email don\'t confirmed.');
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
