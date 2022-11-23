<?php

namespace Core\Repositories\Admin;

use Core\Models\Setting;
use Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Core\Repositories\Common\Traits\SearchRepositoryTrait;

class SettingRepository
{
    use CommonRepositoryTrait,CrudRepositoryTrait,SearchRepositoryTrait;

    protected $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function find($name)
    {
        return $this->model->where('name',$name)->first();
    }
}
