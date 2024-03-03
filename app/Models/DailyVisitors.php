<?php

namespace App\Models;

use App\Services\AuthService;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyVisitors extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;
    protected $table = 'daily_visitors';

    public static function saveView($request)
    {
        $user = AuthService::getAuthorizedUser($request);
        // check unique
        if(self::checkUnique($request->getClientIp())){
            return false;
        }
        return self::create([
            'sessionId' => $request->getSession()->getId(),
            'userId' => $user->id ?? null,
            'ip' => $request->getClientIp(),
            'agent' => $request->header('user-agent'),
        ]);
    }

    public static function checkUnique($ip)
    {
        return $view = self::where('ip', '=', $ip)->whereDate('created_at', '=', now())->first();
    }
}
