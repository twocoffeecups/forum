<?php

namespace App\Http\Controllers\Dashboard\Setting\Styles\Logo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Settings\Styles\Logo\UpdateLogoRequest;
use App\Services\Settings\SettingService;

class UpdateLogoController extends Controller
{
    public function __invoke(UpdateLogoRequest $request)
    {
        $logo = $request->validated('logo');
        $result = SettingService::updateLogo($logo);
        if(!$result){
            return response()->json(['message' => 'Error!']);
        }
        return response()->json(['message' => 'The Logo has been successfully changed.']);
    }
}
