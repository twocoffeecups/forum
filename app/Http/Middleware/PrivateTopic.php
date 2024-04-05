<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrivateTopic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $topic = $request->route()->parameter('topic');
        $user = AuthService::getAuthorizedUser($request);
        if($topic->isPrivate()){
            if(!empty($user)){
                if($topic->accessedUsers->contains('id', $user->id) || $topic->author->id === $user->id){
                    return $next($request);
                }
            }
            abort(404);
        }
        return $next($request);
    }
}
