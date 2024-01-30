<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Paginate\PaginateRequest;
use App\Http\Requests\Admin\Report\ProcessReportRequest;
use App\Http\Requests\Admin\Report\RejectReportRequest;
use App\Http\Resources\Admin\Report\ReportResource;
use App\Models\BanList;
use App\Models\Post;
use App\Models\RejectedTopic;
use App\Models\Report;
use App\Models\Topic;
use App\Models\User;
use App\Notifications\ReportProcessed;
use App\Notifications\ReportRejected;
use App\Notifications\ViolatedSiteRules;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    /**
     * @param PaginateRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(PaginateRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = $request->validated();
        $reports = Report::paginate($data['entriesOnPage'], ['*'], 'page', $data['page']);
        return ReportResource::collection($reports);
    }

    public function reject(RejectReportRequest $request, Report $report)
    {
        $data = $request->validated();
        // send notification
        $report->sender->notify(new ReportRejected($report, $data['message']));
        $report->status = 1;
        $report->closed = 1;
        $report->save();
        return response()->json([
            'message' => 'Report deleted. Messages about the reason were sent to the user.',
            'report' => new ReportResource($report),
        ]);
    }

    /**
     * @param ProcessReportRequest $request
     * @param Report $report
     * @return \Illuminate\Http\JsonResponse
     * TODO: перенести в Service. Улучшить, разбить проверки на отдельные методы.
     */
    public function processing(ProcessReportRequest $request, Report $report)
    {
        $data = $request->validated();
        $data['userId'] = $report->user->id;
        $data['reportId'] = $report->id;
        if(!empty($data['totalDaysBan'])){
            $totalDaysBan = $data['totalDaysBan'];
            $data['banEnd'] = Carbon::parse(Carbon::now())->addDays($totalDaysBan);
        }
        $action = $data['action'];
        $message = $data['message'];
        $warn = $data['warn']=='true' ? true:false;
        unset($data['message'], $data['action'], $data['totalDaysBan'], $data['warn']);

        /** DB transaction
         */
        DB::beginTransaction();
        // action
        if($report->object==='post' || $action==1){
            if($report->object==='topic'){
                $topic = Topic::find($report->topic->id);
                $topic->delete();
            }else{
                $post = Post::find($report->post->id);
                $post->delete();
            }
        }else {
            $topic = Topic::find($report->topic->id);
            $rejectedTopic = RejectedTopic::firstOrCreate(['topicId' => $topic->id], [
                'topicId' => $topic->id,
                'userId' => $topic->author->id,
                'reasonId' => $data['reasonId'],
                'message' => $message,
            ]);
            $topic->status = 0;
            $topic->save();
        }

        // add user in ban list or check warned
        if($warn===true){
            $user = User::find($report->user->id);
            $user->isWarned = 1;
            $user->save();
        }else{
            $ban = BanList::where('userId', '=', $data['userId'])->first();
            if($ban!=null){
                $ban->banEnd = Carbon::parse($ban->banEnd)->addDays($totalDaysBan);
                $ban->save();
            }else{
                $ban = BanList::firstOrCreate(['userId' => $data['userId']], $data);
            }
        }
        $report->status = 1;
        $report->closed = 1;
        $report->save();

        // send user notification
        $report->sender->notify(new ReportProcessed($report, $warn, $totalDaysBan ?? null));
        $report->user->notify(new ViolatedSiteRules($report, $message, $warn, $ban ?? null));
        DB::commit();
        /** DB end transaction */
        return response()->json([
            'message' => 'Report processed.',
            'report' => new ReportResource($report),
        ]);
    }

    /**
     * @param Report $report
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Report $report): \Illuminate\Http\JsonResponse
    {
        return response()->json(['report' => new ReportResource($report)]);
    }
}
