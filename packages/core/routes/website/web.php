<?php
use Illuminate\Support\Facades\Route;


Route::post('logout','LogoutController@destroy')->name('logout');

if(config('website.route.home') !== false){
    Route::get('/','HomeController@index')->name('home');
}

