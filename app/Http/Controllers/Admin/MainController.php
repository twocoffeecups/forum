<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        //dd('admin main controller');
        return view('admin.main.index');
    }

    public function store(){
        dd('adin store');
    }
}
