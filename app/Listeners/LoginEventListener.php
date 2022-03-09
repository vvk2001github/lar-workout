<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;


class LoginEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \IlluminateAuthEventsLogin  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if($event->user->id === 1) {
            if(!$event->user->hasRole('role_superadmin')) $event->user->assignRole('role_superadmin');
        }
        $event->user->assignRole('role_user');
    }
}
