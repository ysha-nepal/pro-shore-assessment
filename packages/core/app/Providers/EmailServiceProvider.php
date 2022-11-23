<?php

namespace Core\Providers;

use Core\Models\Setting;
use Illuminate\Mail\MailManager;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Support\Facades\Schema;

class EmailServiceProvider extends MailServiceProvider
{

    /**
     * Register the Illuminate mailer instance.
     *
     * @return void
     */
    protected function registerIlluminateMailer()
    {
        if(Schema::hasTable('core_settings')){
            $setting = Setting::where('name','email-settings')->first()->values ?? [];
            $email_setting = [
                'transport' => 'smtp',
                'host' => $setting['MAIL_HOST'] ?? config('mail.mailers.smtp.host'),
                'port' => $setting['MAIL_PORT'] ?? config('mail.mailers.smtp.port'),
                'encryption' => $setting['MAIL_ENCRYPTION'] ?? config('mail.mailers.smtp.encryption'),
                'username' =>  $setting['MAIL_USERNAME'] ?? config('mail.mailers.smtp.username'),
                'password' => $setting['MAIL_PASSWORD'] ?? config('mail.mailers.smtp.password'),
                'timeout' => null,
                'auth_mode' => null,
            ];
            config(['mail.mailers.smtp' => $email_setting]);
            config(['mail.from' => [
                'address' =>  $setting['MAIL_FROM_ADDRESS'] ?? config('mail.from.address'),
                'name' => $setting['MAIL_FROM_NAME'] ?? config('mail.from.name')
            ]]);
            $this->app->singleton('mail.manager', function ($app) {
                return new MailManager($app);
            });

            $this->app->bind('mailer', function ($app) {
                return $app->make('mail.manager')->mailer();
            });
        }
    }
}
