<?php

namespace App\Http\Controllers\Forum\Settings;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Settings\BackgroundResource;
use App\Http\Resources\Forum\Settings\ForumNameResource;
use App\Http\Resources\Forum\Settings\LogoResource;
use App\Http\Resources\Forum\Settings\ShowOnlyLogoResource;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __invoke()
    {
        $settings = new Settings();
        return response()->json([
            'forumName' => new ForumNameResource($settings->getForumName()),
            'logo' => new LogoResource($settings->getLogoImage()),
            'background' => new BackgroundResource($settings->getBackgroundImage()),
            'showOnlyLogo' => new ShowOnlyLogoResource($settings->getShowOnlyLogo()),
        ]);
    }
}
