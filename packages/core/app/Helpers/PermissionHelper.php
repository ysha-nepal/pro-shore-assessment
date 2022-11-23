<?php

namespace Core\Helpers;


use Core\Models\Permission;

class PermissionHelper
{
    protected $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function dropdown()
    {
        return $this->model->get()->groupBy('package_name');
    }

    public function selected($permissions)
    {
        return $permissions->pluck('id')->toArray();
    }
}
