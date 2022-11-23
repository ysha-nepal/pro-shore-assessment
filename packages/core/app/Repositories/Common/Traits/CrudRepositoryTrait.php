<?php

namespace Core\Repositories\Common\Traits;

/**
 * Trait CrudRepositoryTrait
 * @package Core\Repositories\Common\Traits
 */
trait CrudRepositoryTrait
{

    /**
     * Create a new row
     *
     * @param  array $data
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function store($data)
    {
        $model = $this->model->create($data);
        if ($this->model->pivots) {
            foreach ($this->model->pivots as $pivot) {
                if (isset($data[$pivot])) {
                    $model->$pivot()->sync($data[$pivot]);
                }
            }
        }
        return $model;
    }

    /**
     * if exits update or create a new row
     * @param $prev
     * @param $data
     * @return mixed
     */
    public function updateOrCreate($prev, $data)
    {
        return $this->model->updateOrCreate($prev, $data);
    }

    /**
     * Update a row
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $model = $this->model->find($id);
        $model->update($data);
        if ($model->pivots) {
            foreach ($model->pivots as $pivot) {
                if (isset($data[$pivot])) {
                    $model->$pivot()->sync($data[$pivot]);
                }
            }
        }
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
        if ($model->pivots) {
            foreach ($model->pivots as $pivot) {
                $model->$pivot()->sync([]);
            }
        }
        return $model->delete();
    }

    /**
     * @param $id
     * @param $sort
     * @return mixed
     */
    public function updateSort($id, $sort)
    {
        $model = $this->model->find($id);
        $model->update([
            $model->sortField => $sort
        ]);
        return $model;
    }

    public function searchable($params)
    {
        if (isset($params['types'])) {
            $types = $params['types'];
            $values = $params['values'];
            foreach ($types as $key => $type) {
                if (isset($values[$key]) && $values[$key] !== "") {
                    $this->model =  $this->model->where($type, 'like', "%" . $values[$key]  . "%");
                }
            }
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function scope()
    {
        return $this;
    }

    public function filterParent($params, $model)
    {
        if ($model->parent && isset($params['parent_id'])) {
            $this->model = $this->model->where($model->parent, $params['parent_id']);
        }
        return $this;
    }
}
