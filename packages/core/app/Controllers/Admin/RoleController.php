<?php

namespace Core\Controllers\Admin;

use App\Http\Controllers\Controller;
use Core\Controllers\Traits\CrudTrait;
use Core\Repositories\Admin\RoleRepository;
use Core\UI\RoleUI;

class RoleController extends Controller
{
    use CrudTrait;

    public function __construct(RoleRepository $model)
    {
        $this->model = $model;
        $this->ui = new RoleUI;
        $this->view = "roles";
        $this->package = "core";
        $this->title = "Roles";
    }
}
