<?php

namespace App\Http\Controllers\Dashboard\Main;

use App\Http\Controllers\Controller;

class MainController extends Controller
{

    public function index()
    {
        return response()->json(['main' => 'Admin dashboard.']);
    }
}
