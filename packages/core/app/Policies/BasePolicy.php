<?php

namespace Core\Policies;

use Core\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BasePolicy
{
    use HandlesAuthorization;


    protected $name;


    public function index(User $user)
    {
        return $user->can("Manage $this->name");
    }

    public function create(User $user)
    {
        return $user->can("Create $this->name");
    }

    public function edit(User $user)
    {
        return $user->can("Edit $this->name");
    }

    public function delete(User $user)
    {
        return $user->can("Delete $this->name");
    }
}
