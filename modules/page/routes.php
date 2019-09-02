<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'module' => 'page', 'middleware' => 'auth'], function() {
    Route::group(['prefix' => 'page'], function() {
        Route::get('/', 'PageController@index')->name('admin.page.index');
        Route::get('create', 'PageController@create')->name('admin.page.create');
        Route::get('edit/{id}', 'PageController@edit')->name('admin.page.edit');
        Route::get('view/{id}', 'PageController@view')->name('admin.page.view');
        Route::post('store', 'PageController@store')->name('admin.page.store');
        Route::post('update/{id}', 'PageController@update')->name('admin.page.update');
        Route::post('delete/{id}', 'PageController@delete')->name('admin.page.delete');
        Route::get('toggle/{id}/{field}', 'PageController@toggle')->name('admin.page.toggle');
    });
});

