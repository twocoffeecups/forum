<?php

namespace App\Http\Controllers\Client\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Search\SearchRequest;
use App\Http\Resources\Forum\Search\PostSearchResource;
use App\Http\Resources\Forum\Search\TopicSearchResource;
use App\Models\Post;
use App\Models\Topic;


class SearchController extends Controller
{
    /**
     * @param SearchRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(SearchRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        if(empty($data['search'])){
            return response()->json([],204);
        }
        // topics
        $topics = Topic::where(function($query) use($data) {
            $query->where('title', 'LIKE', "%{$data['search']}%")
                ->orWhere('content', 'LIKE', "%{$data['search']}%");
        })->where('status', '=', 1)->get();
        // posts
        $posts = Post::where('message', 'LIKE', "%{$data['search']}%")->get();
        $result = TopicSearchResource::collection($topics)
            ->concat(PostSearchResource::collection($posts));

        return response()->json([
            'results' => $result->forPage($data['page'], 2),
            'totalFound' => count($result),
            'paginate' => [
                'current_page' => $data['page'],
                'total_page' => round(count($result) / 2),
            ],
        ]);
    }

}
