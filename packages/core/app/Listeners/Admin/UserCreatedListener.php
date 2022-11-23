<?php

namespace Core\Listeners\Admin;

use Core\Events\Admin\UserCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserCreatedListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        $model = $event->model;
        $model->update([
            'memberable_id' => $model->id,
            'memberable_type' => get_class($model)
        ]);
    }
}
