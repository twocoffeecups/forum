<?php

namespace App\Http\Controllers\Api\Dashboard\Setting\General\ForumName;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Settings\General\DontShowForumNameRequest;
use App\Services\Settings\SettingService;

class DontShowForumNameController extends Controller
{
    public function __invoke(DontShowForumNameRequest $request)
    {
        $data = $request->validated();
        SettingService::updateShowOnlyLogo($data);
        return response()->json(['message' => 'The forum name visibility has been successfully changed.']);
    }
}
