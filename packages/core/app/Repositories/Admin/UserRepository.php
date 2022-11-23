<?php

namespace Core\Repositories\Admin;

use Core\Models\User;
use Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Core\Repositories\Common\Traits\PivotRepositoryTrait;
use Core\Repositories\Common\Traits\SearchRepositoryTrait;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    use CommonRepositoryTrait,CrudRepositoryTrait,SearchRepositoryTrait;

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function store($data,$member=null)
    {
        $data['password'] = Hash::make($data['password']);
        $model = $this->model->create($data);
        if ($this->model->pivots) {
            foreach ($this->model->pivots as $pivot) {
                if (isset($data[$pivot])) {
                    $model->$pivot()->sync($data[$pivot]);
                }
            }
        }
        $model->update([
            'memberable_id' => $member ? $member->id : $model->id,
            'memberable_type' => $member ? get_class($member) : get_class($model)
        ]);
        return $model;
    }

    /**
     * Delete a particular row
     *
     * @param  integer $id
     * @return boolean
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        if ($this->model->pivots) {
            foreach ($this->model->pivots as $pivot) {
                $model->$pivot()->sync([]);
            }
        }
        if($model->memberable){
            $model->memberable->delete();
        }
        return $model->delete();
    }
}
