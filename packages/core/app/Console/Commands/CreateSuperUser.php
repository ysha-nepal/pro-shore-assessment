<?php

namespace Core\Console\Commands;

use Core\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateSuperUser extends Command
{
    protected $signature = "generate:super-user";

    protected $descritption = "Creates super user with all the permission";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $truncate = $this->confirm("Do you want to remove all the users", false);
        if($truncate){
            User::truncate();
        }
        $name = $this->ask("What is your name ?");
        $email = $this->ask("What is your email");
        $password = $this->secret("What is the password");
        $confirm_password = $this->secret("Please confirm the password");

        if($password === $confirm_password){
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ]);
            $role = Role::findByName("Administrator");
            $user->assignRole($role);
            $this->info("Created Super User $email");
            $user->update([
                'memberable_id' => $user->id,
                'memberable_type' => get_class($user)
            ]);
        }else{
            $this->error("Password and Password Confirmation Did not Match");
        }
    }
}
