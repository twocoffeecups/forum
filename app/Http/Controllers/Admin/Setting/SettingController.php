<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Settings\BackgroundResource;
use App\Http\Resources\Admin\Settings\ForumNameResource;
use App\Http\Resources\Admin\Settings\LogoResource;
use App\Http\Resources\Admin\Settings\MetaResource;
use App\Http\Resources\Admin\Settings\PostsOnPageResource;
use App\Http\Resources\Admin\Settings\SettingResource;
use App\Http\Resources\Admin\Settings\ShowOnlyLogoResource;
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
