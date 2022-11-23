<?php
use Illuminate\Support\Facades\Route;

Route::get('/settings/email/test','SettingController@sendTestEmail')->name('settings.email');
