<?php

namespace Core\Console\Commands;

use Core\Models\Permission;
use Core\Models\User;
use Core\Services\PackageService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CorePermission extends Command
{
    protected $signature = "generate:permission";

    protected $descritption = "Seeds the permissions And roles";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $confirm = $this->confirm("Are you sure you want to reset permissions");
        if($confirm)
        {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('role_has_permissions')->truncate();
            DB::table('model_has_permissions')->truncate();
            DB::table('model_has_roles')->truncate();
            Role::truncate();
            Permission::truncate();
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
            $role = Role::create(['name' => "Administrator"]);
            $packages = PackageService::packages();
            foreach ($packages as $package => $name) {
                $this->info("Running Permission for $name");
                if(config("$package.permissions")){
                    foreach(config("$package.permissions") as $permission)
                    {
                        $this->info("Creating permission $permission");

                        $permission = Permission::create([
                            'package_name'=> $package,
                            'name' => $permission
                        ]);
                        $role->givePermissionTo($permission);
                    }
                }
            }

            $user = User::find(1);
            if($user){
                $user->assignRole($role);
            }
        }
    }
}
