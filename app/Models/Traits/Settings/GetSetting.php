<?php

namespace App\Models\Traits\Settings;

trait GetSetting
{
    public function getForumName()
    {
        return $this->where('variable', '=', 'forumName')->first();
    }

    public function getMeta()
    {
        return $this->where('variable', '=', 'meta')->first();
    }

    public function getPostsOnPage()
    {
        return $this->where('variable', '=', 'postsOnPage')->first();
    }

    public function getTopicsOnPage()
    {
        return $this->where('variable', '=', 'topicsOnPage')->first();
    }

    public function getLogoImage()
    {
        return $this->where('variable', '=', 'logo')->first();
    }

    public function getBackgroundImage()
    {
        return $this->where('variable', '=', 'background')->first();
    }

    public function getShowOnlyLogo()
    {
        return $this->where('variable', '=', 'showOnlyLogo')->first();
    }
}
