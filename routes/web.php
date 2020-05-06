<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin{any}', 'SpaController@admin')->where('any', '.*');

Route::get('/login', 'SpaController@login');

Route::get('/{any}', 'SpaController@index')->where('any', '.*');