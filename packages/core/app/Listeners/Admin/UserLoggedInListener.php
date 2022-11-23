<?php

namespace Core\Listeners\Admin;

use Core\Helpers\ActivityLogHelper;
use Core\Notifications\UserLoggedInNotification;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserLoggedInListener
{
    private ActivityLogHelper $logHelper;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ActivityLogHelper $logHelper)
    {
        $this->logHelper = $logHelper;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $this->logHelper->loggedIn($event->user);
        $event->user->notify(new UserLoggedInNotification());
    }
}
