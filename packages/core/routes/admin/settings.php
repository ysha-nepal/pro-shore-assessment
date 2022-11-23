<?php

use Illuminate\Support\Facades\Route;

Route::get('settings/{name?}', 'SettingController@show')->name('settings.edit');
Route::put('settings/{name}', 'SettingController@update')->name('settings.update');
