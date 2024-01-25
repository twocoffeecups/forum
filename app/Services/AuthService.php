<?php

namespace App\Services;

use App\Models\BanList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    // TODO: переделать
    public static function checkEndOfBan($user)
    {
        $bannedUser = BanList::where('userId', $user->id)->first();
        $nowDate = Carbon::parse(Carbon::now());
        $endBanTime = Carbon::parse($bannedUser->banEnd);
        if ($nowDate >= $endBanTime) {
            $bannedUser->banExclude = 1;
            $bannedUser->save();
            $bannedUser->delete();
            return true;
        } else {
            return false;
        }
    }

    public static function deleteFromBanList()
    {

    }

}
