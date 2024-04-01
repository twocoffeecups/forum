<?php

namespace App\Services;

use App\Models\BanList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    /**
     * @param Request $request
     * @return User|null
     */
    public static function getAuthorizedUser(Request $request): User|null
    {
        $user = Auth::user() ?? self::getUserByToken($request);
        return $user;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public static function getUserByToken(Request $request): mixed
    {
        $hashedToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($hashedToken);
        if(!$token){
            return null;
        }
        $user = $token->tokenable;
        return $user;
    }

    public static function checkEndOfBan($user)
    {
        $ban = BanList::where('userId', $user->id)->first();
        if(!$ban) return true;
        $banEnded = Carbon::parse($ban->banEnd)->lessThanOrEqualTo(now());
        if ($banEnded) {
            return self::deleteFromBanList($ban);
        } else {
            return false;
        }
    }

    protected static function deleteFromBanList($ban): bool
    {
        $ban->banExclude = 1;
        $ban->save();
        $ban->delete();
        return true;
    }
}
