<?php

namespace App\Http\Controllers\Admin\Setting\General\Meta;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\General\ChangeMetaRequest;
use App\Services\Settings\SettingService;

class ChangeMetaController extends Controller
{
    public function __invoke(ChangeMetaRequest $request)
    {
        $data = $request->validated();
        SettingService::updateMeta($data);
        return response()->json(['message' => 'The meta has been successfully changed.']);
    }
}
