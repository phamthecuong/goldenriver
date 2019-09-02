<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function() {
    Route::group(['prefix' => 'cms', 'module' => 'cms'], function() {

        Route::group(['prefix' => 'category'], function() {
            Route::get('/', 'CategoryController@index')->name('admin.cms.category.index');
            Route::get('create', 'CategoryController@create')->name('admin.cms.category.create');
            Route::post('store', 'CategoryController@store')->name('admin.cms.category.store');
            Route::get('view/{id}', 'CategoryController@view')->name('admin.cms.category.view');
            Route::get('edit/{id}', 'CategoryController@edit')->name('admin.cms.category.edit');
            Route::post('update/{id}', 'CategoryController@update')->name('admin.cms.category.update');
            Route::get('delete/{id}', 'CategoryController@delete')->name('admin.cms.category.delete');
            Route::get('change-state/{id}', 'CategoryController@toggleState')->name('admin.cms.category.state');
        });

        Route::group(['prefix' => 'post'], function() {
            Route::get('/', 'PostController@index')->name('admin.cms.post.index');
            Route::get('deleted', 'PostController@listDeleted')->name('admin.cms.post.deleted');
            Route::get('create', 'PostController@create')->name('admin.cms.post.create');
            Route::post('store', 'PostController@store')->name('admin.cms.post.store');
            Route::get('view/{id}', 'PostController@view')->name('admin.cms.post.view');
            Route::get('edit/{id}', 'PostController@edit')->name('admin.cms.post.edit');
            Route::post('update/{id}', 'PostController@update')->name('admin.cms.post.update');
            Route::get('state/{id}/{field}', 'PostController@state')->name('admin.cms.post.state');
            Route::post('delete/{id}', 'PostController@delete')->name('admin.cms.post.delete');
        });
    });
});

