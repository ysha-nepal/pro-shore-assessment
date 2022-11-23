<?php

namespace Core\Console\Commands;

use Core\Models\Setting;
use Core\Services\PackageService;
use Illuminate\Console\Command;

class CoreSetting extends Command
{
    protected $signature = "generate:setting";

    protected $description = "Seeds the settings table";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $confirm = $this->confirm("Are you sure you want to reset setting");
        if ($confirm) {
            Setting::truncate();
            $packages = PackageService::packages();
            $settings = config("core.settings");
            foreach($settings as $setting)
            {
                Setting::updateOrCreate(['name' => $setting['name']],$setting);
            }
            unset($packages['core']);
            foreach($packages as $package => $name)
            {
                $settings = config("$package.settings");
                if($settings){
                    foreach($settings as $setting)
                    {
                        Setting::updateOrCreate(['name' => $setting['name']],$setting);
                    }
                }
            }
        }
    }
}
