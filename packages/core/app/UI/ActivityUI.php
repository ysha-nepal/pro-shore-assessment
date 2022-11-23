<?php

namespace Core\UI;

use Core\UI\BaseUI;

class ActivityUI extends BaseUI
{
    public $route = 'activities';

    public $title = "Activities";

    public $columns = [
        'event' => 'Event',
        'description' => "Description",
        'created_at' => 'Created',
        'causer' => 'Causer'
    ];

    public $with = ['causer'];

    public $permissions = [
        'index' => 'Manage Activities',
        'create' => 'Create Activities',
        'edit' => 'Edit Activities',
        'store' => 'Create Activities',
        'update' => 'Edit Activities',
        'destroy' => 'Delete Activities',
        'status' => 'Edit Activities',
    ];

    public function getActions()
    {
        return [
            'show' => [
                'placeholder' => 'View',
                'icon' => 'bi bi-eye',
                'permission' => $this->permissions['index'],
                'route' => "admin.$this->route.show",
            ],
            'delete' => [
                'permission' => $this->permissions['destroy'],
                'route' => "admin.$this->route.destroy",
            ]
        ];
    }
    public function created_at($model)
    {
        return $model->created_at->diffForHumans();
    }

    public function causer($model): string
    {
        if($model->causer){
            return $model->causer->name;
        }
        return 'Guest';
    }

    public function description($model): string
    {
        return \Illuminate\Support\Str::words($model->description, 5);
    }
}
