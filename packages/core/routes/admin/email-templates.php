<?php


use Illuminate\Support\Facades\Route;

Route::get('email-templates/{id}/status', 'EmailTemplateController@changeStatus')->name('email-templates.status');
Route::resource('email-templates', 'EmailTemplateController');
