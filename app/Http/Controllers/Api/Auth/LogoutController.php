<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{

    public function __invoke()
    {
        auth()->user()->tokens()->delete();
        auth()->guard('web')->logout();
        return response()->json(['messages'=>'Logout successful!']);
    }

}
