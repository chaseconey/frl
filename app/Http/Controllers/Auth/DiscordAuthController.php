<?php


namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class DiscordAuthController
{

    public function redirect()
    {
        return Socialite::driver('discord')->redirect();
    }

    public function callback(Request $request)
    {
        $discordResp = Socialite::driver('discord')->user();

        $user = $request->user();
        $user->discord_user_id = $discordResp->getId();
        $user->save();

        return redirect()->route('dashboard');
    }

}
