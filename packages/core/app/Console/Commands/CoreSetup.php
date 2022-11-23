<?php

namespace Core\Console\Commands;

use Core\Models\Backup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;


class CoreSetup extends Command
{
    protected $signature = "package:setup";

    protected $description = "Cms Setup";
    /**
     * @var Backup
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $file = base_path() . "/packages/core/config/logs/log-viewer.php";
        $config = config_path("log-viewer.php");
        \File::copy($file,$config);
        $confirm = $this->confirm("Generate Key ?");
        if ($confirm) {
            $this->call('key:generate');
        }
        $confirm = $this->confirm("Run Migrations ?");
        if($confirm){
            $this->call('package:migrate');
        }
        $confirm = $this->confirm("Generate Permissions ?");
        if($confirm){
            $this->call('generate:permission');
        }
        $confirm = $this->confirm("Generate Menu ?");
        if($confirm) {
           $this->call('generate:menu');
        }
        $confirm = $this->confirm("Generate Setting ?");
        if($confirm) {
           $this->call('generate:setting');
        }
        $confirm = $this->confirm("Generate Super User ?");
        if($confirm) {
            $this->call('generate:super-user');
        }
    }
}
