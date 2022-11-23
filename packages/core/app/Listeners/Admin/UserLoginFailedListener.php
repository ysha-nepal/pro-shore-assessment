<?php

namespace Core\Listeners\Admin;

use Core\Helpers\ActivityLogHelper;
use Core\Notifications\UserLoggedInNotification;
use Illuminate\Auth\Events\Failed;


class UserLoginFailedListener
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
    public function handle(Failed $event)
    {
        $this->logHelper->loginFailed($event->credentials);
    }
}
