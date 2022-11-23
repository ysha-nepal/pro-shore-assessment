<?php

namespace Core\Middlewares;

use Carbon\Carbon;
use Core\Models\User;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = config('app.locale');
        if(Schema::hasTable('core_settings')) {
            $lang = setting_helper('app-settings','lang');
            if($lang !== ""){
                $locale = $lang;
            }
        }
        if(session('locale')){
            $locale = session('locale');
        }
        App::setLocale($locale);
        return $next($request);
    }
}
