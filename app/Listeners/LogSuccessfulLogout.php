<?php

namespace App\Listeners;

use IlluminateAuthEventsLogout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\LoginActivity;
use Illuminate\Auth\Events\Logout;
class LogSuccessfulLogout
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
    public function handle(Logout $event): void
    {
        LoginActivity::where('user_id', $event->user->id)
            ->whereNull('logout_at')
            ->latest()
            ->first()
            ?->update([

                'logout_at' => now()

            ]);
    }
}
