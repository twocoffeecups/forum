<?php

namespace App\Http\Controllers\Dashboard\TopicRejectType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Requests\Dashboard\TopicRejectType\TopicRejectTypeStoreRequest;
use App\Http\Requests\Dashboard\TopicRejectType\TopicRejectTypeUpdateRequest;
use App\Http\Resources\Dashboard\TopicRejectType\TopicRejectTypeResource;
use App\Models\TopicRejectType;
use App\Services\AuthService;

class TopicRejectTypeController extends Controller
{
    /**
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    protected function index(PaginateRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $paginate = $request->validated();
        $rejectTypes = TopicRejectType::paginate($paginate['entriesOnPage'], '*', 'page', $paginate['page']);
        return TopicRejectTypeResource::collection($rejectTypes);
    }

    /**
     * @param TopicRejectTypeStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function store(TopicRejectTypeStoreRequest $request): \Illuminate\Http\JsonResponse
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

    /**
     * @param TopicRejectType $reason
     * @return \Illuminate\Http\JsonResponse
     */
    protected function show(TopicRejectType $reason): \Illuminate\Http\JsonResponse
    {
        return response()->json(['rejectType' => new TopicRejectTypeResource($reason)]);
    }

    /**
     * @param TopicRejectTypeUpdateRequest $request
     * @param TopicRejectType $rejectType
     * @return \Illuminate\Http\JsonResponse
     */
    protected function update(TopicRejectTypeUpdateRequest $request, TopicRejectType $rejectType): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $rejectType->fill($data);
        $rejectType->save();
        return response()->json(['message' => 'Topic reject type updated.']);

    }

    /**
     * @param TopicRejectType $rejectType
     * @return \Illuminate\Http\JsonResponse
     */
    protected function delete(TopicRejectType $rejectType): \Illuminate\Http\JsonResponse
    {
        $rejectType->delete();
        return response()->json(['message' => 'Topic reject type deleted.']);
    }

    /**
     * @param TopicRejectType $rejectType
     * @return \Illuminate\Http\JsonResponse
     */
    protected function status(TopicRejectType $rejectType): \Illuminate\Http\JsonResponse
    {
        $rejectType->status = !$rejectType->status;
        $rejectType->save();
        return response()->json(['message' => 'Topic reject type status changed.']);
    }

}
