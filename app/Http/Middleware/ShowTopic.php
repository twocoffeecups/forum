<?php

namespace App\Http\Middleware;

use App\Models\Topic;
use App\Services\AuthService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowTopic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $topic = $request->route()->parameter('topic');
        $user = AuthService::getAuthorizedUser($request);
        if($topic->status === 0){
            if(!empty($user)){
                if($topic->userId === $user->id){
                    return $next($request);
                }
                if($user->hasPermissionTo('can_reject_topic')){
                    return $next($request);
                }
            }
            abort(404);
        }
        return $next($request);
    }
}
