<?php

namespace Core\Console\Commands;

use Core\Services\PackageService;
use Illuminate\Console\Command;

class CoreMigrate extends Command
{
    protected $signature = "package:migrate";

    protected $descritption = "Migrates from the packages";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $confirmMigrations = $this->confirm("Are you sure you want to run migrations");
        $freshMigrations = $this->confirm("Do you want to run fresh migraions. Default is No.",false);
        if($confirmMigrations)
        {
            $command = $freshMigrations ? "migrate:fresh" : "migrate";
            $packages = PackageService::packages();
            foreach($packages as $package => $name)
            {
                $confirm = $this->confirm("Do you want to run migration for $name",false);
                if($confirm){
                    $this->info("Running Migrations for $name");
                    $path = "/packages/$package/database/migrations";
                    $this->call($command,['--path' => $path]);
                    $command = "migrate";
                }
            }
        }
    }
}
