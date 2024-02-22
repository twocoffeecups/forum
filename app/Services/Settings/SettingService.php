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
        $forumName->data = $data;
        return $forumName->save();
    }

    public static function updateMeta(array $data)
    {
        $settings = new Settings();
        $meta = $settings->getMeta();
        $meta->data = $data;
        return $meta->save();

    }

    public static function updatePostsOnPage($data)
    {
        $settings = new Settings();
        $postsOnPage = $settings->getPostsOnPage();
        $postsOnPage->data = $data;
        return $postsOnPage->save();
    }

    public static function updateTopicsOnPage($data)
    {
        $settings = new Settings();
        $postsOnPage = $settings->getTopicsOnPage();
        $postsOnPage->data = $data;
        return $postsOnPage->save();
    }

    public static function updateLogo($data)
    {
        $settings = new Settings();
        $logo = $settings->getLogoImage();
        if(json_decode($logo->data, true)['value']!=='default'){
            $oldLogoPath = json_decode($logo->data, true)['imagePath'];
            Storage::disk('public')->delete($oldLogoPath);
        }
        $imageName = 'logo_' . md5(Carbon::now() . '_' . $data->getClientOriginalName()) . '.' . $data->getClientOriginalExtension();
        $imagePath = Storage::disk('public')->putFileAs('/assets/images/logo', $data, $imageName);
        $logo->data = [
            'imageName' => $imageName,
            'imagePath' => $imagePath,
            'imageUrl' => url('/storage/' .$imagePath),
        ];

        return $logo->save();
    }

    public static function updateBackground($data)
    {
        $settings = new Settings();
        $background = $settings->getBackgroundImage();
        if(json_decode($background->data, true)['value']!=='default'){
            $oldBackgroundPath = json_decode($background->data, true)['imagePath'];
            Storage::disk('public')->delete($oldBackgroundPath);
        }
        $imageName = 'background_' . md5(Carbon::now() . '_' . $data->getClientOriginalName()) . '.' . $data->getClientOriginalExtension();
        $imagePath = Storage::disk('public')->putFileAs('/assets/images/background', $data, $imageName);
        $background->data = [
            'imageName' => $imageName,
            'imagePath' => $imagePath,
            'imageUrl' => url('/storage/' . $imagePath),
        ];
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
        $show->data = $data;
        return $show->save();
    }
}
