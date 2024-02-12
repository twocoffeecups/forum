<?php

namespace App\Http\Controllers\Client\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['tags' => Tag::all()]);
    }

}
