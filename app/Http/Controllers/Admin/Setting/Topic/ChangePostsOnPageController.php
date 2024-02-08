<?php

namespace App\Http\Controllers\Admin\Setting\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\Post\ChangePostsOnPageRequest;
use App\Services\Settings\SettingService;

class ChangePostsOnPageController extends Controller
{
    public function __invoke(ChangePostsOnPageRequest $request)
    {
        $data = $request->validated();
        SettingService::updatePostsOnPage($data);
        return response()->json(['message' => 'Max posts on topic\'s page has been successfully changed.']);
    }
}
