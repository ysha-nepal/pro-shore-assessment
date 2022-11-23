<?php

namespace Core\Helpers;

use Core\Models\Menu;

class MenuHelper
{
    /**
     * @var Menu
     */
    private $model;

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }

    public function getMenuOrder()
    {
        return $this->model->orderBy('order','ASC')->get();
    }
}
