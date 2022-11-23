<?php

namespace Core\UI;

use Core\UI\BaseUI;

class EmailTemplateUI extends BaseUI
{
    public $route = 'email-templates';

    public $title = "Email Templates";

    public $columns = [
        'title' => 'Title',
        'slug' => 'Slug'
    ];

    public $permissions = [
        'index' => 'Manage EmailTemplates',
        'create' => 'Create EmailTemplates',
        'edit' => 'Edit EmailTemplates',
        'store' => 'Create EmailTemplates',
        'update' => 'Edit EmailTemplates',
        'destroy' => 'Delete EmailTemplates',
        'status' => 'Edit EmailTemplates'
    ];

    public $with = [];

    public function getActions()
    {
        return [
            'status' => [
                'permission' => $this->permissions['edit'],
                'route' => "admin.$this->route.status",
            ],
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
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'subject'=> 'required|string|max:255',
            'content'=> 'string|required',
        ],
        'update' => [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'subject'=> 'nullable|string|max:255',
            'content'=> 'string|required',
        ]
    ];
}
