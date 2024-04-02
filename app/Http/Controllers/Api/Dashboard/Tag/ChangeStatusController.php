<?php

namespace App\Http\Controllers\Api\Dashboard\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class ChangeStatusController extends Controller
{
    /**
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     * Change tag status(visiblity)
     */
    public function __invoke(Tag $tag): \Illuminate\Http\JsonResponse
    {
        $tag->status = !$tag->status;
        $tag->save();
        return response()->json(['message' => 'Tag status changed.']);
    }
}
