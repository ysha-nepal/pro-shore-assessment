<?php

namespace Core\Providers;

use Core\Console\Commands\CoreBackup;
use Core\Console\Commands\CoreEvent;
use Core\Console\Commands\CoreEventListenersNotification;
use Core\Console\Commands\CoreListeners;
use Core\Console\Commands\CoreMenu;
use Core\Console\Commands\CoreMigrate;
use Core\Console\Commands\CoreMigration;
use Core\Console\Commands\CoreModel;
use Core\Console\Commands\CoreNotifications;
use Core\Console\Commands\CorePackage;
use Core\Console\Commands\CorePermission;
use Core\Console\Commands\CoreResource;
use Core\Console\Commands\CoreSetting;
use Core\Console\Commands\CoreSetup;
use Core\Console\Commands\CreateSuperUser;
use Core\Middlewares\Localization;
use Core\Middlewares\UserStatus;
use Core\Middlewares\ViewLogs;
use Core\Services\CoreViewService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;



class CoreServiceProvider extends ServiceProvider
{

    protected array $commands = [
        CoreMigrate::class,
        CorePermission::class,
        CreateSuperUser::class,
        CoreMigration::class,
        CoreModel::class,
        CoreMenu::class,
        CoreSetting::class,
        CorePackage::class,
        CoreBackup::class,
        CoreResource::class,
        CoreSetup::class,
        CoreEvent::class,
        CoreListeners::class,
        CoreNotifications::class,
        CoreEventListenersNotification::class
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->register_configs();
        $this->register_views();
        $this->include_helpers();
        $this->register_langs();
        $this->registerViewFinder();
        $this->commands($this->commands);
    }

    public function register_configs()
    {
        $packages = \Core\Services\PackageService::packages();
        foreach($packages as $package => $name)
        {
            $files = glob(base_path() . "/packages/$package/config/*.{php}", GLOB_BRACE);

            foreach($files as $file)
            {
                $config = str_replace(".php","", basename($file));
                $this->mergeConfigFrom($file,"$package.$config");
            }
        }

    }

    public function register_views()
    {
        $packages = \Core\Services\PackageService::packages();
        foreach ($packages as $package => $name) {
            $views = base_path() . "/packages/$package/resources/views";
            $this->loadViewsFrom($views,$package);
        }
    }


    public function registerViewFinder()
    {
        //over riding default view behaviour
        $this->app->bind('view.finder', function ($app) {
            return new CoreViewService($app['files'], $app['config']['view.paths']);
        });
    }

    public function include_helpers()
    {
        $packages = \Core\Services\PackageService::packages();
        foreach ($packages as $package => $name) {
            $helper = base_path() . "/packages/$package/helpers.php";
            if (file_exists($helper)) {
                include($helper);
            }
        }
    }

    public function register_langs()
    {
        $packages = \Core\Services\PackageService::packages();
        foreach ($packages as $package => $name) {
            $path = base_path() . "/packages/$package/lang";
            $this->loadTranslationsFrom($path,$package);
        }
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('router')->aliasMiddleware('role', \Spatie\Permission\Middlewares\RoleMiddleware::class);
        app('router')->aliasMiddleware('permission', \Spatie\Permission\Middlewares\PermissionMiddleware::class);
        app('router')->aliasMiddleware('role_or_permission', \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class);
        app('router')->aliasMiddleware('view_logs', ViewLogs::class);
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('web', UserStatus::class);
        $router->pushMiddlewareToGroup('web', Localization::class);
        $macros = base_path() . "/packages/core/macros.php";
        require($macros);
        Paginator::useBootstrap();
        Blade::extend(function ($value, $compiler) {
            return preg_replace("/@set\('(.*?)'\,(.*)\)/", '<?php $$1 = $2; ?>', $value);
        });
    }
}
