<?php

namespace App\Http\Controllers\Admin\Setting\Styles\Background;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\Styles\Background\UpdateBackgroundRequest;
use App\Services\Settings\SettingService;

class UpdateBackgroundController extends Controller
{
    public function __invoke(UpdateBackgroundRequest $request)
    {
        $background = $request->validated('background');
        $result = SettingService::updateBackground($background);
        if(!$result){
            return response()->json(['message' => 'Error!']);
        }
        return response()->json(['message' => 'The background has been successfully changed.']);
    }
}
