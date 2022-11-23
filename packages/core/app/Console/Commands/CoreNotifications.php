<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;


class CoreNotifications extends Command
{
    protected $signature = "generate:notification {notification} {package} {dir?}";

    protected $description = "Creates the events inside the packages";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $notification = $this->argument('notification');
        $package = $this->argument('package');
        $upackage = ucfirst($package);
        $dir = $this->argument('dir') ?? 'Admin';
        $stub = base_path() . '/packages/core/stubs/';

        if(file_exists(base_path() . "/packages/$package")){
            $path = base_path() . "/packages/$package/app/Notifications";
            if(!is_dir($path)){
                mkdir($path);
            }
            $template = file_get_contents($stub . 'notification.stub');
            $variables = [
                'NOTIFICATION' => $notification,
                'PACKAGE' => $upackage,
                'DIR' => $dir
            ];
            foreach ($variables as $key => $value) {
                $template = str_replace("{{{$key}}}", $value, $template);
            }
            $path = base_path() . '/packages/' . $package . '/app/Notifications';
            file_put_contents($path . "/$notification.php", $template);

        }else{
            $this->error("Package does not exist");
        }
    }

}
