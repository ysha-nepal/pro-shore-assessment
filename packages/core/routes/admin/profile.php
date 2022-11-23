<?php

use Illuminate\Support\Facades\Route;

Route::get('user/profile', 'UserController@profile')->name('user.profile');
Route::post('user/profile/update/{id}', 'UserController@profileUpdate')->name('user-profile.update');
Route::get('change-password', 'UserController@changePassword')->name('user.change-password');
Route::post('change-password/store/{id}', 'UserController@storeChangePassword')->name('change-password.store');
