<?php

namespace App\Http\Controllers\Admin\TopicRejectType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TopicRejectType\TopicRejectTypeStoreRequest;
use App\Http\Requests\Admin\TopicRejectType\TopicRejectTypeUpdateRequest;
use App\Http\Resources\Admin\TopicRejectType\TopicRejectTypeResource;
use App\Models\TopicRejectType;

class TopicRejectTypeController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function index(): \Illuminate\Http\JsonResponse
    {
        $rejectTypes = TopicRejectType::all();
        return response()->json(['rejectTypes' => TopicRejectTypeResource::collection($rejectTypes)]);
    }

    /**
     * @param TopicRejectTypeStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function store(TopicRejectTypeStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = $this->getUserByToken($request);
        $data['userId'] = $user->id;
        //dd($data);
        $rejectType = TopicRejectType::firstOrCreate($data);
        return response()->json(['message' => 'Topic reject type created.']);
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
        //dd($data, $rejectType);
        foreach($data as $key => $value) {
            $rejectType->$key = $value;
        }
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
