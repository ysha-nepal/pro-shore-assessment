<?php

namespace Core\Composers;

use Core\Models\Setting;
use Illuminate\View\View;

class SettingComposer
{
    protected $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function compose(View $view)
    {
        $settings = $this->setting->select('name','permission','display_name')->get();
        $view->with('settings', $settings);
    }
}
