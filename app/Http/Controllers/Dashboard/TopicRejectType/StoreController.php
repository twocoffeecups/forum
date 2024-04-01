<?php

namespace App\Http\Controllers\Dashboard\TopicRejectType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TopicRejectType\TopicRejectTypeStoreRequest;
use App\Http\Resources\Dashboard\TopicRejectType\TopicRejectTypeResource;
use App\Models\TopicRejectType;
use App\Services\AuthService;

class StoreController extends Controller
{
    /**
     * @param TopicRejectTypeStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TopicRejectTypeStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = AuthService::getAuthorizedUser($request);
        $data['userId'] = $user->id;
        $rejectType = TopicRejectType::firstOrCreate($data);
        return response()->json([
            'message' => 'Topic reject type created.',
            'rejectedType' => new TopicRejectTypeResource($rejectType),
        ]);
    }
}
