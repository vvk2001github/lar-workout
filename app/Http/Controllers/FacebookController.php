<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Helpers\socialProvider;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    public function fbCallback() {
        $fbUser = Socialite::driver('facebook')->user();

        $user = User::where('email', $fbUser->email)->first();

        if ($user) {
            // $user->update([
            //     'github_token' => $githubUser->token,
            //     'github_refresh_token' => $githubUser->refreshToken,
            // ]);
        } else {
            $user = User::create([
                'name' => $fbUser->name,
                'email' => $fbUser->email ?? 'undefined',
                'provider' => socialProvider::FACEBOOK,
            ]);
        }

        Auth::login($user);

        return redirect('/');
    }
}
