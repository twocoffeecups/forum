<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Forum spa application
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function __invoke()
    {
        $settings = new Settings();
        $meta = json_decode($settings->getMeta()->data, true);
        $description = $meta['description'];
        $keywords = $meta['keywords'];
        return view('forum.main', compact('description', 'keywords'));
    }
}
