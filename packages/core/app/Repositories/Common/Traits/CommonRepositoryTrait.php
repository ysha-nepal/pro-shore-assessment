<?php

namespace Core\Repositories\Common\Traits;

/**
 * Trait CommonRepositoryTrait
 * @package Core\Repositories\Common\Traits
 */
trait CommonRepositoryTrait
{
    // public function __call($name, $arguments)
    // {
    //     $this->model = $this->model->$name(...$arguments);
    //     return $this->model;
    // }

    /**
     * @param null $records
     * @return mixed
     */
    public function paginate($records = null)
    {
        $records = ($records == null) ? 10 : $records;
        return $this->model->paginate($records);
    }

    /**
     * @param $columns
     * @return mixed
     */
    public function get($columns = [])
    {
        $query = $this->model->query();

        if ($columns) {
            $query = $query->get($columns);
            return $query;
        }
        return $this->model->get();
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param $select_string
     * @return $this
     */
    public function select($select_string)
    {
        $this->model = $this->model->select($select_string);
        return $this;
    }


    /**
     * @param int $default
     * @return mixed
     */
    public function limit($default = 100)
    {
        $this->model = $this->model->limit($default);
        return $this;
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->model->first();
    }

    /**
     * @param $field
     * @return $this
     */
    public function with($field)
    {
        $this->model = $this->model->with($field);
        return $this;
    }

    /**
     * @param $field
     * @return $this
     */
    public function withCount($field)
    {
        $this->model = $this->model->withCount($field);
        return $this;
    }

    /**
     * @param $id
     */
    public function toggleStatus($id)
    {
        $model = $this->model->find($id);
        $model->status = ($model->status == 0) ? 1 : 0;
        $model->save();
    }

    /**
     * @param $field
     * @param string $method
     * @return $this
     */
    public function order($field, $method = 'desc')
    {
        $this->model = $this->model->orderBy($field, $method);
        return $this;
    }


    /**
     * @param $field
     * @return $this
     */
    public function sortBy($field)
    {
        $this->model = $this->model->sortBy($field);
        return $this;
    }


    /**
     * @param $field
     * @param null $order_type
     * @return $this
     */
    public function orderBy($field, $order_type = null)
    {
        $this->model = $this->model->orderBy($field, $order_type);
        return $this;
    }
}
