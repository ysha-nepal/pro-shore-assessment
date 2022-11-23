<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;


class CoreEvent extends Command
{
    protected $signature = "generate:event {event} {package} {dir?}";

    protected $description = "Creates the events inside the packages";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $event = $this->argument('event');
        $package = $this->argument('package');
        $upackage = ucfirst($package);
        $dir = $this->argument('dir') ?? 'Admin';
        $stub = base_path() . '/packages/core/stubs/';

        if(file_exists(base_path() . "/packages/$package")){
            $path = base_path() . "/packages/$package/app/Events";
            if(!is_dir($path)){
                mkdir($path);
            }
            $template = file_get_contents($stub . 'event.stub');
            $variables = [
                'EVENT' => $event,
                'PACKAGE' => $upackage,
                'DIR' => $dir
            ];
            foreach ($variables as $key => $value) {
                $template = str_replace("{{{$key}}}", $value, $template);
            }
            $path = base_path() . '/packages/' . $package . '/app/Events';
            file_put_contents($path . "/$event.php", $template);

        }else{
            $this->error("Package does not exist");
        }
    }

}
