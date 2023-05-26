<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        //dd('admin main controller');
        //return view('admin.main.index');
        return view('layouts.admin');

    }

//    public function dashboard(){
//        return view('admin.main.index');
//    }
}
