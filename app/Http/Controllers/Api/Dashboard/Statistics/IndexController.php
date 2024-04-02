<?php

namespace App\Http\Controllers\Api\Dashboard\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Topic\TopicResource;
use App\Http\Resources\Dashboard\User\LatestUserResource;
use App\Models\DailyVisitors;
use App\Models\Forum;
use App\Models\Report;
use App\Models\Topic;
use App\Models\User;
use App\Services\Statistics\GetStatistics;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    use GetStatistics;

    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $dailyVisitors = $this->getDailyVisitors();
        $topicForums = $this->getTopicForums();

        $totalUsers = User::all()->count();
        $totalReports = Report::all()->count();
        $totalForums = Forum::all()->count();
        $totalTopics = Topic::all()->count();

        $newTopics = Topic::all()->where('status', '=', 0);
        $latestRegisteredUsers = User::orderBy('created_at', 'desc')->limit(5)->get();

        return response()->json([
            'dailyVisitors' => $dailyVisitors,
            'topicForums' => $topicForums,
            'newTopics' => TopicResource::collection($newTopics),
            'latestUsers' => LatestUserResource::collection($latestRegisteredUsers),
            'stats' => [
                'users' => $totalUsers,
                'topics' => $totalTopics,
                'reports' => $totalReports,
                'forums' => $totalForums,
            ],
        ]);
    }
}
