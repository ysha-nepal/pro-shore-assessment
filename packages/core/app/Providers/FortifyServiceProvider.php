<?php

namespace Core\Providers;

use Core\Actions\Fortify\CreateNewUser;
use Core\Actions\Fortify\ResetUserPassword;
use Core\Actions\Fortify\UpdateUserPassword;
use Core\Actions\Fortify\UpdateUserProfileInformation;
use Core\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(['fortify.username' => 'username']);
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            return Limit::perMinute(100)->by($email.$request->ip());
        });

        Fortify::loginView(function () {
            return view("core::website.auth.login");
        });

        Fortify::registerView(function () {
            return view("core::website.auth.register");
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view("core::website.auth.password.email");
        });

        Fortify::resetPasswordView(function ($request) {
            $email = $request->get('email');
            $token = $request->route('token');
            return view("core::website.auth.password.reset",[
                'email' => $email,
                'token' => $token
            ]);
        });

        Fortify::authenticateUsing(function (LoginRequest $request) {
            $username = $request->get(Fortify::username());
            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $username)->first();
            } else {
                $user = User::where('phone', $username)->first();
            }
            if ($user && $user->status && Hash::check($request->password, $user->password)) {
                return $user;
            }
        });
    }
}
