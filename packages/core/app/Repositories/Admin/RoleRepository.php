<?php

namespace Core\Repositories\Admin;

use Core\Models\Role;
use Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Core\Repositories\Common\Traits\SearchRepositoryTrait;

class RoleRepository
{
    use CommonRepositoryTrait,CrudRepositoryTrait,SearchRepositoryTrait;

    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function store($data)
    {
        $permissions = $data['permissions'] ?? [];
        unset($data['permissions']);
        $model = $this->model->create($data);
        $model->permissions()->sync($permissions);
        return $model;
    }
}