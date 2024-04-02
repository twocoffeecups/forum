<?php

namespace App\Http\Controllers\Api\Dashboard\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class DeleteController extends Controller
{
    /**
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Tag $tag): \Illuminate\Http\JsonResponse
    {
        $tag->delete();
        return response()->json(['message' => 'Tag deleted successfully!']);
    }
}
