<?php

namespace Core\UI;

use Core\UI\BaseUI;

class BackupUI extends BaseUI
{
    public $route = 'backups';

    public $title = "Backups";

    public $columns = [
        'name' => 'Name',
        'size' => "Size"
    ];

    public $permissions = [
        'index' => 'Manage Backups',
        'create' => 'Create Backups',
        'edit' => 'Edit Backups',
        'store' => 'Create Backups',
        'update' => 'Edit Backups',
        'destroy' => 'Delete Backups',
        'status' => 'Edit Backups',
        'download' => 'Download Backups',
    ];

    public function getActions()
    {
        return [
            'download' => [
                'icon' => "bi bi-cloud-download",
                'permission' => $this->permissions['download'],
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
}
