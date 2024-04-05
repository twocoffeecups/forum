<?php

namespace App\Http\Controllers\Api\Dashboard\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Topic\GetUsersRequest;
use App\Http\Resources\Dashboard\Topic\TopicDetailsResource;
use App\Http\Resources\Dashboard\Topic\UsersFormResource;
use App\Models\Topic;
use App\Models\User;

class GetUsersController extends Controller
{
    /**
     * Show topic
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Topic $topic)
    {
        $users = User::all();
        return response()->json(['users' => UsersFormResource::collection($users)]);
    }
}
