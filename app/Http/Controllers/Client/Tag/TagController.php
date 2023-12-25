<?php

namespace App\Http\Controllers\Client\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\Topic\TopicStoreRequest;
use App\Http\Requests\Api\Client\Topic\TopicUpdateRequest;
use App\Http\Resources\Client\Topic\TopicResource;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

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
