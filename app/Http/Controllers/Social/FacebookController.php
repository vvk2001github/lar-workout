<?php

namespace App\Http\Controllers\Social;

use App\Helpers\socialProvider;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function fbCallback() {
        $fbUser = Socialite::driver('facebook')->user();

        $user = User::where('email', $fbUser->email)->first();

        if ($user) {
            $user->update([
                'provider' => socialProvider::FACEBOOK,
            ]);
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
