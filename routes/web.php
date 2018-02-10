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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    //Route::resource('groups', 'GroupsController', ['only' => 'index']);
    //Route::resource('posts', 'PostsController', ['only' => 'index']);//['except' => ['store', 'update', 'delete']]);
    //Route::get('profiles/{user}', 'ProfilesController@show')->name('profile');


    Route::group(['middleware' => ['form']], function () {
        Route::get('/', 'AdminController@index')->name('adminhome');
    });

});