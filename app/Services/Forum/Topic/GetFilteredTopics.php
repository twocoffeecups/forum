<?php


namespace App\Services\Forum\Topic;


use App\Http\Filters\Forum\TopicFilter;
use App\Models\Settings;
use App\Models\Topic;
use App\Services\AuthService;
use Illuminate\Support\Facades\DB;

trait GetFilteredTopics
{

    public function getTopics($filters, $forumId, $request)
    {
        $filtered = app()->make(TopicFilter::class, ['queryParams' => array_filter($filters)]);
        $topicOnPage = Settings::getTopicsOnPageValue();
        $user = AuthService::getAuthorizedUser($request);

        return !empty($user) ?
            $this->getTopicsIncludingPersonal($filtered, $user, $forumId, $topicOnPage, $filters) :
            $this->getPublicTopics($filtered, $forumId, $topicOnPage, $filters);
    }


    private function getPublicTopics($filtered, $forumId, $topicOnPage, $filters)
    {
        return $topics = Topic::filter($filtered)
            ->where('forumId', '=', $forumId)
            ->where('status', '=', 1)
            ->where('type', '!=', '1')
            ->where('private', '!=', 1)
            ->paginate($topicOnPage, ['*'], 'page', $filters['page']);
    }


    private function getTopicsIncludingPersonal($filtered, $user, $forumId, $topicOnPage, $filters)
    {
        return $topics = Topic::filter($filtered)
            ->where('forumId', '=', $forumId)
            ->where('status', '=', 1)
            ->where('type', '!=', '1')
            ->where(function ($q) use ($user) {
                $q->where('private', '!=', 1)
                    ->orWhere(function ($q) use ($user) {
                        $q->orWhere('private', '=', 1)
                            ->where('topics.userId', '=', $user->id)
                            ->orWhereExists(function ($query) use ($user) {
                                $query
                                    ->select(DB::raw('*'))
                                    ->from('private_topic_accessed_users')
                                    ->whereColumn('private_topic_accessed_users.topicId', 'topics.id')
                                    ->where('private_topic_accessed_users.userId', $user->id);
                            });
                    });
            })
            ->paginate($topicOnPage, ['*'], 'page', $filters['page']);
    }
}
