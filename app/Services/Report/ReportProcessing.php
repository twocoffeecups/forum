<?php

namespace App\Services\Report;

use App\Http\Resources\Admin\Report\ReportResource;
use App\Models\BanList;
use App\Models\Post;
use App\Models\RejectedTopic;
use App\Models\Report;
use App\Models\Topic;
use App\Models\User;
use App\Notifications\ReportProcessed;
use App\Notifications\ViolatedSiteRules;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

trait ReportProcessing
{

    /**
     * @param $report
     * @param $data
     * @return \Illuminate\Http\JsonResponse|null
     * Start report processing
     */
    protected function startTheReportProcessing($report, $data): ?\Illuminate\Http\JsonResponse
    {
        // is use warn
        $warn = $data['warn'] === 'true' ? true : false;
        /** Start transaction */
        DB::beginTransaction();
        /** action */
        $action = $this->actionOnTheObject($report, $data);
        if (!$action) {
            return $this->reportProcessingFailed('Failed to delete/reject an object.');
        }
        /** add user in ban list or check warned */
        $ban = $this->checkUserInTheBanList($report, $warn, $data);
        $this->sendUsersNotifications($report, $data['message'], $action, $ban, $warn);
        $this->closeReport($report);
        DB::commit();
        /** End db transaction */
        return $this->reportProcessedSuccessfully($report);
    }

    /**
     * @param Report $report
     * @param $data
     * @return false|string|void|null
     * check topic or post and apply the action
     */
    protected function actionOnTheObject(Report $report, $data)
    {
        if ($report->object === 'post') {
            return $this->deletePost($report->post->id);
        }

        if ($report->object === 'topic') return $data['action'] == 1
            ? $this->deleteTopic($report->topic->id)
            : $this->addToRejectedList($report->topic->id, $data);
    }

    /**
     * @param int $id
     * @return false|string
     */
    protected function deletePost(int $id): false|string
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->reportProcessingFailed('Post not found.');
        }
        return $post->delete() ? self::ACTION_DELETED : false;

    }

    /**
     * @param int $id
     * @return false|string|null
     */
    protected function deleteTopic(int $id)
    {
        $topic = Topic::find($id);
        if (!$topic) {
            return $this->reportProcessingFailed('Topic not found.');
        }
        return $topic->delete() ? self::ACTION_DELETED : false;
    }

    /**
     * @param int $id
     * @param array $data
     * @return false|string|null
     */
    protected function addToRejectedList(int $id, array $data): false|string|null
    {
        $topic = Topic::find($id);
        if (!$topic) {
            return $this->reportProcessingFailed('Topic not found.');
        }
        $topic->status = 0;
        $topic->save();
        $rejectedTopic = RejectedTopic::firstOrCreate(['topicId' => $topic->id], [
            'topicId' => $topic->id,
            'userId' => $topic->author->id,
            'reasonId' => $data['reasonId'],
            'message' => $data['message'],
        ]);

        return $rejectedTopic ? self::ACTION_REJECTED : false;
    }

    /**
     * @param Report $report
     * @param bool $warn
     * @param $data
     * @return BanList|null
     */
    protected function checkUserInTheBanList(Report $report, bool $warn, $data): null|BanList
    {
        if ($warn === true) {
            $this->giveUserWarning($report->user->id);
            return null;
        }
        $ban = $this->isUserBanned($report->user->id, (int)$data['totalDaysBan']);
        if (!$ban) {
            $ban = $this->addUserInBanList($report, $data);
        }
        return $ban;
    }

    /**
     * @param Report $report
     * @param array $data
     * @return BanList
     */
    protected function addUserInBanList(Report $report, array $data): BanList
    {
        return BanList::firstOrCreate(['userId' => $report->userId], [
            'userId' => $report->userId,
            'reportId' => $report->id,
            'reasonId' => $data['reasonId'],
            'banEnd' => Carbon::parse(Carbon::now())->addDays($data['totalDaysBan']),
        ]);
    }

    /**
     * @param int $id
     * @param int $days
     * @return false|BanList
     * is user banned, add days to the ban
     */
    protected function isUserBanned(int $id, int $days): false|BanList
    {
        $ban = BanList::where('userId', '=', $id)->first();
        if (!$ban || $ban->banExclude == 1) {
            return false;
        }
        $ban->banEnd = Carbon::parse($ban->banEnd)->addDays($days);
        $ban->save();
        return $ban;
    }

    /**
     * @param $id
     * @return void
     */
    protected function giveUserWarning($id): void
    {
        $user = User::find($id);
        $user->isWarned = 1;
        $user->save();
    }

    /**
     * @param $report
     * @return void
     */
    protected function closeReport($report): void
    {
        $report->status = 1;
        $report->closed = 1;
        $report->save();
    }

    /**
     * @param Report $report
     * @param string $message
     * @param $action
     * @param BanList|null $ban
     * @param bool $warn
     * @return void
     * Send users notifications
     */
    protected function sendUsersNotifications(Report $report, string $message, $action, null|BanList $ban, bool $warn = false)
    {
        $report->sender->notify(new ReportProcessed($report, $warn, $action, $totalDaysBan ?? null));
        $report->user->notify(new ViolatedSiteRules($report, $message, $warn, $action, $ban ?? null));
    }

    /**
     * @param Report $report
     * @return \Illuminate\Http\JsonResponse
     */
    protected function reportProcessedSuccessfully(Report $report): \Illuminate\Http\JsonResponse
    {

        return response()
            ->json([
                'message' => 'Report processed.',
                'report' => new ReportResource($report),
            ])
            ->sendContent();
    }

    /**
     * @param string $message
     * @return null
     */
    protected function reportProcessingFailed(string $message)
    {
        return response()->json(['message' => $message], 404)->throwResponse();
    }

}
