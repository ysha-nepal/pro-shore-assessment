<?php

namespace Core\Repositories\Admin;

use Core\Models\EmailTemplate;
use Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Core\Repositories\Common\Traits\SearchRepositoryTrait;

class EmailTemplateRepository
{
    use CommonRepositoryTrait, CrudRepositoryTrait, SearchRepositoryTrait;

    protected $model;

    public function __construct(EmailTemplate $model)
    {
        $this->model = $model;
    }
}
