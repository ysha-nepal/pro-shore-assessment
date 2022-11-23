<?php

namespace Core\UI;

use Carbon\Carbon;
use Core\UI\BaseUI;
use Illuminate\Support\Facades\Cache;

class MediaUI extends BaseUI
{
    public $route = 'medias';

    public $title = "Medias";

    public $columns = [
        'title' => 'Title',
        'type' => 'Type',
        'size' => 'Size',
        'user' => 'Uploaded By'
    ];

    public $permissions = [
        'index' => 'Manage Medias',
        'create' => 'Create Medias',
        'edit' => 'Edit Medias',
        'store' => 'Create Medias',
        'update' => 'Edit Medias',
        'destroy' => 'Delete Medias',
        'status' => 'Edit Medias',
        'download' => 'Download Medias'
    ];

    public function getActions()
    {
        return [
            'download' => [
                'icon' => "bi bi-cloud-download",
                'permission' =>  $this->permissions['download'],
                'route' => "admin.$this->route.download",
                'placeholder' => 'Download'
            ],
            'delete' => [
                'permission' => $this->permissions['destroy'],
                'route' => "admin.$this->route.destroy",
            ]
        ];
    }

    public function createAction()
    {
        return [
            'permission' => $this->permissions['create'],
            'route' => "admin.$this->route.create"
        ];
    }

    public $rules = [
        'store' => [
            'medias' => 'array|required',
            'title' => 'required|string|max:255',
            'description' => 'string|nullable|max:500'
        ],
    ];

    public $with = ['user'];

    public function user($model)
    {
        return $model->user->name;
    }
}
