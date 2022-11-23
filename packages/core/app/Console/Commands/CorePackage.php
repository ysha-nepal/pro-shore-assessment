<?php

namespace Core\Console\Commands;

use Illuminate\Console\Command;

class CorePackage extends Command
{
    protected $signature = "generate:package";

    protected $description = "Generates a new package";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name  = $this->ask("Package Name ?");
        $package_path = base_path('packages/' . $name);


        mkdir($package_path . '/app');
        mkdir($package_path . '/app/Controllers');
        mkdir($package_path . '/app/Controllers/Admin');
        mkdir($package_path . '/app/Controllers/Website');
        mkdir($package_path . '/app/Helpers');
        mkdir($package_path . '/app/Models');
        mkdir($package_path . '/app/Repositories');
        mkdir($package_path . '/app/UI');
        mkdir($package_path . '/config');
        mkdir($package_path . '/database');
        mkdir($package_path . '/database/migrations');
        mkdir($package_path . '/resources');
        mkdir($package_path . '/resources/views');
        mkdir($package_path . '/resources/views/admin');
        mkdir($package_path . '/resources/views/website');
        mkdir($package_path . '/routes');
        mkdir($package_path . '/routes/admin');
        mkdir($package_path . '/routes/website');
        mkdir($package_path . '/assets/');
        mkdir($package_path . '/assets/admin');
        mkdir($package_path . '/assets/admin/js');
        mkdir($package_path . '/assets/admin/css');

        $content = '<?php return [];';
        $menus = fopen($package_path .'/config/' . 'menus.php','wb');
        fwrite($menus,$content);
        fclose($menus);
        $permissions = fopen($package_path .'/config/' . 'permissions.php','wb');
        fwrite($permissions,$content);
        fclose($permissions);
    }
}
