<?php

use Illuminate\Support\Facades\Route;

Route::get('/notifications/list','NotificationController@index')->name('notifications.list.index');
Route::get('/notifications/read','NotificationController@read')->name('notifications.list.read');
