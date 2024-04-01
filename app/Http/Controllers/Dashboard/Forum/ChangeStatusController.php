<?php

namespace App\Http\Controllers\Dashboard\Forum;

use App\Http\Controllers\Controller;
use App\Models\Forum;

class ChangeStatusController extends Controller
{
    /**
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Forum $forum): \Illuminate\Http\JsonResponse
    {
        $forum->status = !$forum->status;
        $forum->save();
        return response()->json(['message' => 'Forum status changed!']);
    }
}
