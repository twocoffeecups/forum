<?php

namespace App\Http\Controllers\Api\Forum\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class IndexController extends Controller
{
    /**
     * Get all forum tags
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['tags' => Tag::all()]);
    }

}
