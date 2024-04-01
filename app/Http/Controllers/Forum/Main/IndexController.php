<?php

namespace App\Http\Controllers\Forum\Main;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $settings = new Settings();
        $meta = json_decode($settings->getMeta()->data, true);
        $description = $meta['description'];
        $keywords = $meta['keywords'];
        return view('forum.main', compact('description', 'keywords'));
    }
}
