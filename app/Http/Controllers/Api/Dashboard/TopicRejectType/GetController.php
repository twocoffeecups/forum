<?php

namespace App\Http\Controllers\Api\Dashboard\TopicRejectType;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\TopicRejectType\TopicRejectTypeResource;
use App\Models\TopicRejectType;

class GetController extends Controller
{
    /**
     * @param TopicRejectType $reason
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TopicRejectType $reason): \Illuminate\Http\JsonResponse
    {
        return response()->json(['rejectType' => new TopicRejectTypeResource($reason)]);
    }
}
