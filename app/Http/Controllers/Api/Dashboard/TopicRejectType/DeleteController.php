<?php

namespace App\Http\Controllers\Api\Dashboard\TopicRejectType;

use App\Http\Controllers\Controller;
use App\Models\TopicRejectType;

class DeleteController extends Controller
{
    /**
     * @param TopicRejectType $rejectType
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TopicRejectType $rejectType): \Illuminate\Http\JsonResponse
    {
        $rejectType->delete();
        return response()->json(['message' => 'Topic reject type deleted.']);
    }
}
