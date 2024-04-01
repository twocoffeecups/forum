<?php


namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
        return response()->json(['url' => $url]);
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        // if don't token, return access error
        if (!$user->token) {
            $this->returnError();
        }
        // create or get user
        $createdUser = $this->store($user);
        // if user don't have social account, create new
        if ($this->checkHasSocialAccount($createdUser, $provider) !== true)
            $this->createSocialAccount($user, $provider, $createdUser);
        // register event
        event(new Registered($createdUser));
        // login and send token
        Auth::login($createdUser);
        $token = $createdUser->createToken('auth-token')->accessToken;
        return response()->json([
            'accessToken' => $token->token,
        ]);
    }

    protected function store($data)
    {
        return User::firstOrCreate(['email' => $data->email], [
            'email' => $data->email,
            'name' => $data->name,
            'login' => $data->nickname,
            'avatarUrl' => $data->avatar,
            'password' => Hash::make(Str::random(8))
        ]);
    }

    protected function checkHasSocialAccount(User $user, string $provider): bool
    {
        return (bool)$user->socialAccountInfo()->where('provider', '=', $provider)->first();
    }

    protected function createSocialAccount($providerUser, string $provider, User $user)
    {
        return SocialAccount::create([
            'provider_id' => $providerUser->id,
            'provider' => $provider,
            'userId' => $user->id,
        ]);
    }

    protected function returnToken($user): \Illuminate\Http\JsonResponse
    {
        $token = $user->createToken('auth-token')->accessToken;
        return response()->json([
            'accessToken' => $token->token,
        ]);
    }

    protected function returnError(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['message' => 'Access error.'], 403);
    }
}
