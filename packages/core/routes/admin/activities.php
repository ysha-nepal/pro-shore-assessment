<?php
use Illuminate\Support\Facades\Route;

Route::resource('activities','ActivityController')->only(['index','show','destroy']);
