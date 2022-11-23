<?php

namespace Core\Helpers;

use Spatie\Permission\Models\Role;

class RoleHelper
{
    protected $model;

    public function __construct(Role $model )
    {
        $this->model = $model;
    }

    public function dropdown()
    {
        return $this->model->pluck('name','id');
    }

}
