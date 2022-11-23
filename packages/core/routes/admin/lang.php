<?php

use Illuminate\Support\Facades\Route;

Route::get('/lang/{locale}','LangController@change')->name('lang.change');
