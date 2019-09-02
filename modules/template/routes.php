<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'template'], function() {
    Route::get('/', 'DefaultController@index')->name('template.default.index');
});

