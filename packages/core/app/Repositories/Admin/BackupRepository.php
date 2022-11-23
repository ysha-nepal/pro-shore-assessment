<?php

namespace Core\Repositories\Admin;

use Core\Models\Backup;
use Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Core\Repositories\Common\Traits\SearchRepositoryTrait;

class BackupRepository
{
    use CommonRepositoryTrait, CrudRepositoryTrait, SearchRepositoryTrait;

    protected $model;

    public function __construct(Backup $model)
    {
        $this->model = $model;
    }
}
