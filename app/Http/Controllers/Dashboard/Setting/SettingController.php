<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Settings\BackgroundResource;
use App\Http\Resources\Dashboard\Settings\LogoResource;
use App\Http\Resources\Dashboard\Settings\SettingResource;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __invoke()
    {
        $settings = new Settings();
        return response()->json([
            'forumName' => new SettingResource($settings->getForumName()),
            'logo' => new LogoResource($settings->getLogoImage()),
            'background' => new BackgroundResource($settings->getBackgroundImage()),
            'showOnlyLogo' => new SettingResource($settings->getShowOnlyLogo()),
            'meta' => new SettingResource($settings->getMeta()),
            'postsOnPage' => new SettingResource($settings->getPostsOnPage()),
            'topicsOnPage' => new SettingResource($settings->getTopicsOnPage()),
        ]);
    }
}
