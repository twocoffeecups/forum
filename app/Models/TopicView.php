<?php

namespace App\Models;

use App\Services\AuthService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class TopicView extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;
    protected $table = 'topic_views';

    public static function saveView(Request $request, Topic $topic)
    {
        $user = AuthService::getAuthorizedUser($request);
        $view = TopicView::where('topicId', '=', $topic->id)->where('ip', '=', $request->getClientIp())->first();
        //dd($view);
        if(!$view){
            $view = TopicView::create([
                'topicId' => $topic->id,
                'url' => $request->url(),
                'sessionId' => $request->getSession()->getId(),
                'userId' => $user->id ?? null,
                'ip' => $request->getClientIp(),
                'agent' => $request->header('user-agent'),
            ]);
        }
        return $view;
    }
}
