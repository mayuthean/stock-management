<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>'auth'], function(){
    
    Route::get('/', 'DashboardController@index');
    //Users route
    Route::get('user', 'UserController@index');
    Route::get('user/create', 'UserController@create');
    Route::get('user/delete/{id}', 'UserController@delete');
    Route::get('user/edit/{id}', 'UserController@edit');
    Route::post('user/save', 'UserController@save');
    Route::post('user/update', 'UserController@update');
    Route::get('user/logout', 'UserController@logout');
    // Role Route
    Route::get('role','RoleController@index');
    Route::get('role/create','RoleController@create');
    Route::get('role/delete/{id}','RoleController@delete');
    Route::post('role/save','RoleController@save');
    Route::get('role/edit/{id}','RoleController@edit');
    Route::post('role/update','RoleController@update');
});
Auth::routes();