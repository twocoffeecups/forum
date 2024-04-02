<?php

namespace App\Http\Controllers\Api\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\RegisterRequest;
use App\Mail\Client\User\PasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Register new user
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->validated();
        $password = Str::random(12);
        $data['password'] = Hash::make($password);
        $user = User::firstOrCreate(['login' => $data['login']], $data);
//        Mail::to($user->email)->send(new VerifyMail($user->id, $user->login, sha1($user->getEmailForVerification())));
        Mail::to($user->email)->send(new PasswordMail($password, $user->getEmailForVerification()));
        event(new Registered($user));
        return response()->json([
            'message' => 'New user register successfully!',
        ], 201);
    }
}
