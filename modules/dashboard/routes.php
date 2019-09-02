<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function() {
    Route::get('/', 'DefaultController@index')->name('admin.dashboard.index');

    Route::group(['prefix' => 'dashboard', 'module' => 'dashboard'], function() {
        Route::get('/', 'DefaultController@index')->name('admin.dashboard.index');
    });
});

