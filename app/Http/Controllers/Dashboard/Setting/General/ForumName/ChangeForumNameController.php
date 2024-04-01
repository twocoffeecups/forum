<?php

namespace App\Http\Controllers\Dashboard\Setting\General\ForumName;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Settings\General\ChangeForumNameRequest;
use App\Services\Settings\SettingService;

class ChangeForumNameController extends Controller
{
    public function __invoke(ChangeForumNameRequest $request)
    {
        $name = $request->validated();
        SettingService::updateForumName($name);
        return response()->json(['message' => 'The forum name has been successfully changed.']);
    }
}
