<?php

namespace App\Http\Controllers\Client\Forum;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\Stats\ForumStatsResource;
use App\Http\Resources\Client\Stats\LastUserResource;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;

class ForumStatsController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        //dd(111111111111111111);
        $stats = [
            'posts' => Post::all()->count(),
            'topics' => Topic::all()->count(),
            'users' => User::all()->count(),
            'lastUser' => new LastUserResource(User::latest()->first()),
        ];
        return response()->json(['stats' => $stats]);
    }

}
