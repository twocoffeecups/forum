<?php

namespace App\Http\Controllers\Client\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Topic\TopicStoreRequest;
use App\Http\Requests\Api\Client\Topic\TopicUpdateRequest;
use App\Http\Resources\Client\Topic\TopicForumTreeResource;
use App\Http\Resources\Client\Topic\TopicResource;
use App\Http\Resources\Client\Topic\TopicTagFormResource;
use App\Libraries\TreeBuilder;
use App\Models\Forum;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\TopicImage;
use App\Models\User;
use App\Services\AuthService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UnapprovedTopicController extends Controller
{
    protected function show(Request $request, Topic $topic)
    {
        $user = AuthService::getAuthorizedUser($request);
        if(($topic->userId!==$user->id && $topic->status!==0) || !$user->admin()){
            return response()->json(['message' => "Topic not found"], 404);
        }
        return response()->json(['topic' => new TopicResource($topic)]);
    }
}
