<?php

namespace App\Http\Controllers\Api\Dashboard\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Tag\TagUpdateRequest;
use App\Models\Tag;

class UpdateController extends Controller
{

    /**
     * @param TagUpdateRequest $request
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TagUpdateRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $tag->fill($data);
        $tag->save();
        return response()->json(['message' => 'Tag updated!']);
    }
}
