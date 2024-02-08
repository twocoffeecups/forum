<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __invoke()
    {
        $settings = new Settings();
        $meta = json_decode($settings->getMeta()->variableData, true);
        $description = $meta['description'];
        $keywords = $meta['keywords'];
        return view('layouts.app', compact('description', 'keywords'));
    }
}
