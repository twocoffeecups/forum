<?php

namespace App\Http\Controllers\Api\Language;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\SetLocaleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SetLocaleController extends Controller
{
    public function __invoke(SetLocaleRequest $request)
    {
        $locale = $request->validated('locale');
        if (! in_array($locale, ['en', 'ru',])) {
            abort(400);
        }
        Session::put('locale', $locale);
        app()->setLocale(session('locale'));
        return response()->json([], 202);
    }
}
