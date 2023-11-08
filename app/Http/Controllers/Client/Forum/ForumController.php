<?php

namespace App\Http\Controllers\Client\Forum;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\Forum\ForumResource;
use App\Models\Forum;


class ForumController extends Controller
{

    protected function show(Forum $forum)
    {
        //dd($forum);
        return response()->json(['forum' => new ForumResource($forum)]);
    }

}
