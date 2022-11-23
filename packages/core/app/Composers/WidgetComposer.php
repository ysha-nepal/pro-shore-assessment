<?php

namespace Core\Composers;

use Core\Models\Menu;
use Illuminate\View\View;

class WidgetComposer
{
    protected $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function compose(View $view)
    {
        $packages = \Core\Services\PackageService::packages();
        $widgets = [
            'core' => config('core.widgets')
        ];
        //core widgets
        unset($packages['core']);
        foreach($packages as $package => $name){
            if(config("$package.widgets")){
                $widgets[$package] = config("$package.widgets");
            }
        }
        $view->with('package_widgets', $widgets);
    }
}
