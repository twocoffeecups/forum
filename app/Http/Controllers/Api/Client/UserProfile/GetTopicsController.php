<?php

namespace App\Http\Controllers\Api\Client\UserProfile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Forum\Forum\TopicResource;
use App\Models\Topic;
use App\Models\User;

class GetTopicsController extends Controller
{
    /**

     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(PaginateRequest $request, User $user): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = $request->validated();
        $topics = Topic::where('userId', $user->id)
            ->where('status', '=', 1)
            ->where('private', '!=', 1)
            ->paginate(5, ['*'], 'page', $data['page']);
        return TopicResource::collection($topics);
    }
}
