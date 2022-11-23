<?php

namespace Core\Policies;

use Core\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends BasePolicy
{

    public function __construct()
    {
        $this->name = "Users";
    }
}
