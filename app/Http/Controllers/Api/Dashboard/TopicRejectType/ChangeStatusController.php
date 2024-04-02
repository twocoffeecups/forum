<?php

namespace App\Http\Controllers\Api\Dashboard\TopicRejectType;

use App\Http\Controllers\Controller;
use App\Models\TopicRejectType;

class ChangeStatusController extends Controller
{
    /**
     * @param TopicRejectType $rejectType
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TopicRejectType $rejectType): \Illuminate\Http\JsonResponse
    {
        $rejectType->status = !$rejectType->status;
        $rejectType->save();
        return response()->json(['message' => 'Topic reject type status changed.']);
    }

}
