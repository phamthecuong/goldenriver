<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function() {
    Route::group(['prefix' => 'core', 'module' => 'core'], function() {
        Route::get('/', 'UserController@index')->name('admin.core.index');

        Route::group(['prefix' => 'user'], function() {
            Route::get('/', 'UserController@index')->name('admin.core.user.index');
            Route::get('create', 'UserController@create')->name('admin.core.user.create');
            Route::post('store', 'UserController@store')->name('admin.core.user.store');
            Route::get('view/{id}', 'UserController@view')->name('admin.core.user.view');
            Route::get('edit/{id}', 'UserController@edit')->name('admin.core.user.edit');
            Route::post('update/{id}', 'UserController@update')->name('admin.core.user.update');
            Route::get('change-state/{id}', 'UserController@changeState')->name('admin.core.user.state');
            Route::get('delete/{id}', 'UserController@delete')->name('admin.core.user.delete');
            Route::get('user-info/{id}', 'UserController@getUser')->name('admin.core.user.getUser');
        });

        Route::group(['prefix' => 'navigation'], function () {
            Route::get('/', 'NavigationController@index')->name('admin.core.nav.index');
            Route::get('create', 'NavigationController@create')->name('admin.core.nav.create');
            Route::get('edit/{id}', 'NavigationController@edit')->name('admin.core.nav.edit');
            Route::get('toggle/{id}', 'NavigationController@toggle')->name('admin.core.nav.toggle');
            Route::get('delete/{id}', 'NavigationController@remove')->name('admin.core.nav.delete');
            Route::post('store', 'NavigationController@store')->name('admin.core.nav.store');
            Route::post('update/{id}', 'NavigationController@update')->name('admin.core.nav.update');
        });

        Route::group(['prefix' => 'role'], function() {
            Route::get('/', 'RoleController@index')->name('admin.core.role.index');
            Route::get('create', 'RoleController@create')->name('admin.core.role.create');
            Route::post('store', 'RoleController@store')->name('admin.core.role.store');
            Route::get('view/{id}', 'RoleController@view')->name('admin.core.role.view');
            Route::get('edit/{id}', 'RoleController@edit')->name('admin.core.role.edit');
            Route::get('delete/{id}', 'RoleController@delete')->name('admin.core.role.delete');
            Route::get('permission/{id}', 'RoleController@permission')->name('admin.core.role.permission');
            Route::post('permission/{id}', 'RoleController@addPermissionRole')->name('admin.core.role.addPermission');
        });

        Route::group(['prefix' => 'permission'], function() {
            Route::get('/', 'PermissionController@index')->name('admin.core.permission.index');
            Route::post('role', 'PermissionController@permission')->name('admin.core.permission.role');
        });
    });
});
