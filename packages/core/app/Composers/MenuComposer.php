<?php

namespace Core\Composers;

use Core\Models\Menu;
use Illuminate\View\View;

class MenuComposer
{
    protected $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function compose(View $view)
    {
        $menus = $this->menu->where('parent_id',0)->where('status',1)->with('children')->orderBy('order','ASC')->get();
        $view->with('menus',$menus);
    }
}
