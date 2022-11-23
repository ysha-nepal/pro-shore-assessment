<?php

namespace Core\UI;

use Core\UI\BaseUI;

class RoleUI extends BaseUI
{
    public $route = 'roles';

    public $title = "Roles";

    public $columns = [
        'name' => "Name",
    ];

    public $permissions = [
        'index' => 'Manage Roles',
        'create' => 'Create Roles',
        'edit' => 'Edit Roles',
        'store' => 'Create Roles',
        'update' => 'Edit Roles',
        'destroy' => 'Delete Roles',
        'status' => 'Edit Roles'
    ];


    public function getActions()
    {
        return [
            'edit' => [
                'icon' => 'bi bi-pencil-square',
                'permission' => $this->permissions['edit'],
                'route' => "admin.$this->route.edit",
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
            'name' => 'required|max:255|unique:roles',
            'permissions' => 'array'

        ],
        'update' => [
            'name' => 'required|max:255',
            'permissions' => 'array'
        ]
    ];
}
