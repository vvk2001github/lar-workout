<?php

namespace App\Http\Controllers\Social;

use App\Helpers\socialProvider;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GitlabController extends Controller
{
    public function gitlabCallback() {
        $gitlabUser = Socialite::driver('gitlab')->user();

        $user = User::where('email', $gitlabUser->email)->first();

        if ($user) {
            $user->update([
                'provider' => socialProvider::GITLAB,
            ]);
        } else {
            $user = User::create([
                'name' => $gitlabUser->name,
                'email' => $gitlabUser->email ?? 'undefined',
                'provider' => socialProvider::GITLAB,
            ]);
        }

        Auth::login($user);

        return redirect('/');
    }
}
