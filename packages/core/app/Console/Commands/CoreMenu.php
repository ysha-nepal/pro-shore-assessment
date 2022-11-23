<?php

namespace Core\Console\Commands;

use Core\Models\Menu;
use Core\Services\PackageService;
use Illuminate\Console\Command;

class CoreMenu extends Command
{
    protected $signature = "generate:menu";

    protected $description = "Seeds the permissions And roles";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $confirm = $this->confirm("Are you sure you want to reset menu");
        if ($confirm) {
            Menu::truncate();
        }
        $packages = PackageService::packages();
        foreach($packages as $package => $name)
        {
            $confirm = $this->confirm("Do You want to run menu for $name",false);
            if($confirm){
                $menus = config("$package.menus");
                if($menus){
                    foreach ($menus as $menu)
                    {
                        $menu['parent_id'] = 0;
                        if(isset($menu['parent'])){
                            $parent_menu = Menu::where('name',$menu['parent'])->first();
                            $menu['parent_id'] = $parent_menu->id;
                        }
                        $this->info("Creating menu " . $menu['display_name']);
                        unset($menu['parent']);
                        $menu['package'] = $package;
                        Menu::updateOrCreate($menu);
                    }
                }
            }
        }
    }
}
