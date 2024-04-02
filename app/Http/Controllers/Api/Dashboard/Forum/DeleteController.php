<?php

namespace App\Http\Controllers\Api\Dashboard\Forum;

use App\Http\Controllers\Controller;
use App\Models\Forum;

class DeleteController extends Controller
{
    /**
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Forum $forum): \Illuminate\Http\JsonResponse
    {
        if ($forum->children) {
            return response()->json(['message' => 'You cannot delete the forum. Move the child forums'], 413);
        }
        $forum->delete();
        return response()->json(['message' => 'Forum deleted successfully!']);
    }
}
