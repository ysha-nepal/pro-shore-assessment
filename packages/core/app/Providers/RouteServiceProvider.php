<?php

namespace Core\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $packages = [];

    public function map()
    {
        $this->packages = \Core\Services\PackageService::packages();
        $this->mapAdminRoutes();
        $this->mapWebsiteRoutes();
        $this->mapApiRoutes();
        $this->mapWebApiRoutes();
    }

    public function mapAdminRoutes()
    {
        foreach($this->packages as $package => $name)
        {
            Route::name('admin.')
                ->prefix('admin')
                ->middleware(['web','auth', 'permission:View Dashboard'])
                ->namespace("$name\\Controllers\\Admin")
                ->group(function ($router) use ($package) {
                    $files = glob(base_path() . "/packages/$package/routes/admin/*.{php}", GLOB_BRACE);
                    foreach ($files as $file) {
                        require($file);
                    }
                });
        }


    }

    public function mapWebsiteRoutes()
    {
        foreach($this->packages as $package => $name)
        {
            Route::name('website.')
                ->middleware(['web'])
                ->namespace("$name\\Controllers\\Website")
                ->group(function ($router) use ($package) {
                    $files = glob(base_path() . "/packages/$package/routes/website/*.{php}", GLOB_BRACE);
                    foreach ($files as $file) {
                        require($file);
                    }
                });
        }
    }
    public function mapWebApiRoutes()
    {
        foreach($this->packages as $package => $name)
        {
            Route::name('api.')
                ->prefix('api')
                ->middleware(['web'])
                ->namespace("$name\\Controllers\\Api")
                ->group(function ($router) use ($package) {
                    $files = glob(base_path() . "/packages/$package/routes/webapi/*.{php}", GLOB_BRACE);
                    foreach ($files as $file) {
                        require($file);
                    }
                });
        }
    }

    public function mapApiRoutes()
    {
        foreach($this->packages as $package => $name)
        {
            Route::name('api.')
                ->prefix('api')
                ->middleware(['api'])
                ->namespace("$name\\Controllers\\Api")
                ->group(function ($router) use ($package) {
                    $files = glob(base_path() . "/packages/$package/routes/api/*.{php}", GLOB_BRACE);
                    foreach ($files as $file) {
                        require($file);
                    }
                });
        }
    }
}
