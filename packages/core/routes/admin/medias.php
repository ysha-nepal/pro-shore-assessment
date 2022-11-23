<?php

use Illuminate\Support\Facades\Route;

Route::resource('medias', 'MediaController');
Route::get('media/{id}/download', 'MediaController@download')->name('medias.download');
