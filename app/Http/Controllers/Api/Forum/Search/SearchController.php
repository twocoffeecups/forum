<?php

namespace App\Http\Controllers\Api\Forum\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Search\SearchRequest;
use App\Http\Resources\Forum\Search\PostSearchResource;
use App\Http\Resources\Forum\Search\TopicSearchResource;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{
    /**
     * @param SearchRequest $request
     * @return \Illuminate\Http\JsonResponse
     * TODO: переделать
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
        })
            ->where('status', '=', 1)
            ->where('private', '!=', 1)
            ->get();
        // posts
        $posts = Post::where('message', 'LIKE', "%{$data['search']}%")
            ->whereExists(function ($query) {
                $query
                    ->select(DB::raw('*'))
                    ->from('topics')
                    ->whereColumn('topics.id', 'posts.topicId')
                    ->where('topics.private', '!=', 1);
            })
            ->get();
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
