<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;


class CoreEventListenersNotification extends Command
{
    protected $signature = "generate:eln {name} {package} {dir?}";

    protected $description = "Creates the events inside the packages";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $package = $this->argument('package');
        Artisan::call("generate:event",['event' => $name . "Event",'package' => $package]);
        Artisan::call("generate:listener",['listener' => $name . "Listener",'package' => $package]);
        Artisan::call("generate:notification",['notification' => $name . "Notification",'package' => $package]);
    }

}
