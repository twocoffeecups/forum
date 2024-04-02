<?php

namespace App\Http\Controllers\Api\Forum\Stats;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forum\Stats\LastUserResource;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;

class GetController extends Controller
{

    /**
     * Get forum stats
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $stats = [
            'posts' => Post::all()->count(),
            'topics' => Topic::all()->count(),
            'users' => User::all()->count(),
            'lastUser' => new LastUserResource(User::latest()->first()),
        ];
        return response()->json(['stats' => $stats]);
    }

}
