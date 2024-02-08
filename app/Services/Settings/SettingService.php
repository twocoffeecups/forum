<?php

namespace App\Services\Settings;

use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SettingService
{

    private function __construct(){}

    public static function updateForumName($data)
    {
        $settings = new Settings();
        $forumName = $settings->getForumName();
        $forumName->variableData = $data;
        return $forumName->save();
    }

    public static function updateMeta(array $data)
    {
        $settings = new Settings();
        $meta = $settings->getMeta();
        $meta->variableData = $data;
        return $meta->save();

    }

    public static function updatePostsOnPage($data)
    {
        $settings = new Settings();
        $postsOnPage = $settings->getPostsOnPage();
        $postsOnPage->variableData = $data;
        return $postsOnPage->save();
    }

    public static function updateTopicsOnPage($data)
    {
        $settings = new Settings();
        $postsOnPage = $settings->getTopicsOnPage();
        $postsOnPage->variableData = $data;
        return $postsOnPage->save();
    }

    public static function updateLogo($data)
    {
        $settings = new Settings();
        $logo = $settings->getLogoImage();
        $oldLogoPath = json_decode($logo->variableData, true)['imagePath'];
        $imageName = 'logo_' . md5(Carbon::now() . '_' . $data->getClientOriginalName()) . '.' . $data->getClientOriginalExtension();
        $imagePath = Storage::disk('public')->putFileAs('/assets/images/logo', $data, $imageName);
        $logo->variableData = [
            'imageName' => $imageName,
            'imagePath' => $imagePath,
            'imageUrl' => url('/storage/' .$imagePath),
        ];
        Storage::disk('public')->delete($oldLogoPath);
        return $logo->save();
    }

    public static function updateBackground($data)
    {
        $settings = new Settings();
        $background = $settings->getBackgroundImage();
        $oldBackgroundPath = json_decode($background->variableData, true)['imagePath'];
        $imageName = 'background_' . md5(Carbon::now() . '_' . $data->getClientOriginalName()) . '.' . $data->getClientOriginalExtension();
        $imagePath = Storage::disk('public')->putFileAs('/assets/images/background', $data, $imageName);
        $background->variableData = [
            'imageName' => $imageName,
            'imagePath' => $imagePath,
            'imageUrl' => url('/storage/' . $imagePath),
        ];
        Storage::disk('public')->delete($oldBackgroundPath);
        return $background->save();
    }

    /**
     * @param $data
     * @return mixed
     * Change whether the forum name will be displayed in the forum header
     */
    public static function updateShowOnlyLogo($data): mixed
    {
        $settings = new Settings();
        $show = $settings->getShowOnlyLogo();
        $show->variableData = $data;
        return $show->save();
    }
}
