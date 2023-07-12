<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\RegisterRequest;
use App\Mail\Client\User\PasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $password = Str::random(12);
        $data['password'] = Hash::make($password);
        Mail::to($data['email'])->send(new PasswordMail($password, $data['login']));

        dd($data);
        $user = User::firstOrCreate(['login'=>$data['login']],$data);

        return response()->json([
            'message' => 'New user register successfully!',
        ]);
    }
}
