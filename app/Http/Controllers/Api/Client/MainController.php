<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        //dd('client forum template');
        return view('default');
    }
}
