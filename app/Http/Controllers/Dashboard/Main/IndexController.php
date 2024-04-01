<?php

namespace App\Http\Controllers\Dashboard\Main;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function __invoke()
    {
        return view('dashboard.main.index');
    }
}
