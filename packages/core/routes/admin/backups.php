<?php


use Illuminate\Support\Facades\Route;

Route::resource('backups', 'BackupController');
Route::get('backup/{id}/download', 'BackupController@download')->name('backups.download');
