<?php

namespace Core\UI;

use Carbon\Carbon;
use Core\UI\BaseUI;
use Illuminate\Support\Facades\Cache;

class UserUI extends BaseUI
{
    public $route = 'users';

    public $title = "Users";

    public $columns = [
        'avatar' => 'Avatar',
        'name' => 'Name',
        'email' => 'Email',
        'roles' => 'Roles',
        'status' => 'Status',
        'login' => 'Login',
    ];

    public $permissions = [
        'index' => 'Manage Users',
        'create' => 'Create Users',
        'edit' => 'Edit Users',
        'store' => 'Create Users',
        'update' => 'Edit Users',
        'destroy' => 'Delete Users',
        'status' => 'Edit Users'
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
            'name' => 'required|max:255',
            'designation' => 'nullable|string|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|max:255|confirmed',
            'roles' => 'array|nullable'
        ],
        'update' => [
            'name' => 'required|max:255',
            'designation' => 'nullable|max:255',
            'roles' => 'array|nullable'
        ]
    ];

    public function avatar($model)
    {
        return "<img src='$model->avatar' style='width:30px;'>" ;
    }

    public function roles($model)
    {
        return implode(',', $model->roles->pluck('name')->toArray());
    }

    public function status($model)
    {
        return view('core::admin.layouts.components.status',['model' => $model]);
    }

    public function login($model)
    {
        $online = false;
        if(Cache::has('user-is-online-' . $model->id)){
            $online = true;
        }
        return view('core::admin.layouts.components.online',['online' => $online]);
    }

    public function getChangePasswordRules()
    {
        return [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function getProfileUpdateRules()
    {
        return [
            'name' => 'required|max:255',
            'designation' => 'nullable|max:255',
        ];
    }
}
