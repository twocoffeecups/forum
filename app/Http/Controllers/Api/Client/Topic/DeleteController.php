<?php

namespace App\Http\Controllers\Api\Client\Topic;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Delete topic
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Topic $topic): \Illuminate\Http\JsonResponse
    {
        if ($topic->posts != 0) {
            return response()->json(['message' => "You can't delete a topic because there are posts for it"], 406);
        }
        $topic->delete();
        return response()->json(['message' => 'Topic deleted.']);
    }
}
