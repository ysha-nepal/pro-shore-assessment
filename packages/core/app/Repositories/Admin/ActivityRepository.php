<?php

namespace Core\Repositories\Admin;

use Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Core\Repositories\Common\Traits\SearchRepositoryTrait;
use Spatie\Activitylog\Models\Activity;

class ActivityRepository
{
    use CommonRepositoryTrait, CrudRepositoryTrait, SearchRepositoryTrait;

    protected $model;

    public function __construct(Activity $model)
    {
        $this->model = $model;
    }

    public function searchable($params)
    {
        if(isset($params['event']) && $params['event'] !== ""){
            $this->model = $this->model->where('event',$params['event']);
        }
        return $this;
    }

    public function scope()
    {
        $this->model = $this->model->orderBy('created_at','desc');
        return $this;
    }
}
