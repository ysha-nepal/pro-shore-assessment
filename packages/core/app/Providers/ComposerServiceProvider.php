<?php

namespace Core\Providers;

use Core\Composers\MenuComposer;
use Core\Composers\SettingComposer;
use Core\Composers\WidgetComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('core::admin.layouts.partials.sidebar',MenuComposer::class);
        View::composer('core::admin.settings.index', SettingComposer::class);
        View::composer('*::admin.dashboard',WidgetComposer::class);
    }
}
