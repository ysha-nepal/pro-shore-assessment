<?php

namespace Core\Policies;

use Core\Models\Setting;
use Core\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{

    use HandlesAuthorization;


    public function show(User $user,Setting $model)
    {
        return $user->can($model->permission);
    }

    public function update(User $user, Setting $model)
    {
        return $user->can($model->permission);
    }
}
