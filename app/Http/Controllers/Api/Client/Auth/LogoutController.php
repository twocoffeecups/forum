<?php

namespace App\Http\Controllers\Api\Client\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{

    public function __invoke()
    {
        //dd('Logout');
        auth()->user()->tokens()->delete();
        auth()->guard('web')->logout();
        //auth()->logout();
        return response()->json(['messages'=>'Logout successful!']);
    }

}
