<?php

namespace Event\Repositories\Admin;

use Event\Models\Event;
use Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Core\Repositories\Common\Traits\SearchRepositoryTrait;
use Illuminate\Support\Facades\Auth;

/**
 * Class EventRepository
 * @package Event\Repositories\Admin
 */
class EventRepository
{
    use CommonRepositoryTrait, CrudRepositoryTrait, SearchRepositoryTrait;

    /**
     * @var Event
     */
    public $model;

    /**
     * @param Event $model
     */
    public function __construct(Event $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new row
     *
     * @param  array $data
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function store($data)
    {
        $data['created_by'] = Auth::id();
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
     * @return $this
     */
    public function scope()
    {
        $this->model = $this->model->orderBy('start_date_ad','asc');
        return $this;
    }

    /**
     * @param $params
     * @return $this
     */
    public function searchable($params)
    {
        //clean up empty keys
        $params = array_filter($params);
        if(isset($params['title'])){
            $this->model = $this->model->where(function($q) use ($params){
                $q->where('title','like',"%{$params['title']}%")
                    ->orWhere('slug','like',"%{$params['title']}%");
            });
        }
        if(isset($params['filter'])){
            if($params['filter'] === "1"){
                $this->model = $this->model->whereDate('start_date_ad','<=',now())
                    ->whereDate('end_date_ad','>=',now());
            }
            if($params['filter'] === "2"){
                $this->model = $this->model->whereDate('start_date_ad','>',now());
            }
            if($params['filter'] === "3"){
                $this->model = $this->model->whereDate('start_date_ad','<',now()->addDays(7))
                                ->whereDate('start_date_ad','>',now());
            }
            if($params['filter'] === "4"){
                $this->model = $this->model->whereDate('end_date_ad','<',now());
            }
            if($params['filter'] === "5"){
                $this->model = $this->model->whereDate('end_date_ad','>',now()->subDays(7))
                    ->whereDate('end_date_ad','<',now());
            }
        }
        return $this;
    }
}
