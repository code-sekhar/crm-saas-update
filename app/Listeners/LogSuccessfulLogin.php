<?php

namespace App\Listeners;

use IlluminateAuthEventsLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\LoginActivity;
use Illuminate\Auth\Events\Login;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
     public function handle(Login $event): void
        {
            $user = $event->user;

            $agent = new Agent();
            $location = Location::get(request()->ip());

            LoginActivity::create([

                'tenant_id' => $user->tenant_id,

                'user_id' => $user->id,

                'ip_address' => request()->ip(),

                'browser' => $agent->browser(),

                'platform' => $agent->platform(),

                'device' => $agent->device(),

                 'country' => $location ? $location->countryName : null,

                 'city' => $location ? $location->cityName : null,

                'login_at' => now(),

            ]);

            $user->update([

                'last_login_at' => now()

            ]);
        }
}
