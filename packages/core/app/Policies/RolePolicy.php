<?php

namespace Core\Policies;


class RolePolicy extends BasePolicy
{

    public function __construct()
    {
        $this->name = "Users";
    }
}
