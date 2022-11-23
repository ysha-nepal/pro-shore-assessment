<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;

class CoreMigration extends Command
{
    protected $signature = "package:migration {name} {package}";

    protected $descritption = "Creates migrations inside the package";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = "create_" . $this->argument("name") . "_table";
        $package = $this->argument("package");
        $path = "/packages/$package/database/migrations";
        if(file_exists(base_path() . $path)){
            $this->call("make:migration",["name" => $name,"--path" => $path]);
        }else{
            $this->error("Package does not exit");
        };
    }
}
