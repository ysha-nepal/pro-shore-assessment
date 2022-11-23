<?php

namespace Core\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Translation\TranslationServiceProvider;
use Core\Services\CoreTranslator;
use Core\Models\Setting;

class CoreTranslationServiceProvider extends TranslationServiceProvider
{
    public function register()
    {
        $this->registerLoader();

        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];

            // When registering the translator component, we'll need to set the default
            // locale as well as the fallback locale. So, we'll grab the application
            // configuration, so we can easily get both of these values from there.
            $locale = $app['config']['app.locale'];
            if(Schema::hasTable('core_settings')) {
                $lang = setting_helper('app-settings','lang');
                if($lang !== ""){
                    $locale = $lang;
                }
            }
            if(session('locale')){
                $locale = session('locale');
            }
            $trans = new CoreTranslator($loader, $locale);
            $trans->setFallback($app['config']['app.fallback_locale']);
            return $trans;
        });
    }
}
