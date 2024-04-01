<?php

namespace App\Http\Controllers\Dashboard\TopicRejectType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TopicRejectType\TopicRejectTypeUpdateRequest;
use App\Models\TopicRejectType;

class UpdateController extends Controller
{
    /**
     * @param TopicRejectTypeUpdateRequest $request
     * @param TopicRejectType $rejectType
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TopicRejectTypeUpdateRequest $request, TopicRejectType $rejectType): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $rejectType->fill($data);
        $rejectType->save();
        return response()->json(['message' => 'Topic reject type updated.']);

    }
}
