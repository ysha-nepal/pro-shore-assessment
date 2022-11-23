<?php
use Illuminate\Support\Facades\Route;

Route::get('medias','MediaController@index')->name('medias');
Route::post('medias/upload', 'MediaController@upload')->name('media.upload');
