<?php

namespace App\Http\Controllers\Api\Dashboard\Setting\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Settings\Topic\ChangeTopicsOnPageRequest;
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
