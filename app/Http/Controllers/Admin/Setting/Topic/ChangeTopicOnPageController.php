<?php

namespace App\Http\Controllers\Admin\Setting\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\Topic\ChangeTopicsOnPageRequest;
use App\Services\Settings\SettingService;

class ChangeTopicOnPageController extends Controller
{
    public function __invoke(ChangeTopicsOnPageRequest $request)
    {
        $data = $request->validated();
        SettingService::updateTopicsOnPage($data);
        return response()->json(['message' => 'Max topics on forum\'s page has been successfully changed.']);
    }
}
