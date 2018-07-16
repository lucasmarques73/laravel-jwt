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

Route::group(['prefix' => 'auth'], function(){
    Route::post('login',['as' => 'auth.login', 'uses' => 'AuthController@login']);
    Route::get('logout',['as' => 'auth.logout', 'uses' => 'AuthController@logout']);
    Route::post('refresh',['as' => 'auth.refresh', 'uses' => 'AuthController@refreshToken']);
    Route::get('user',['as' => 'auth.user', 'uses' => 'AuthController@getAuthUser']);
});

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'user'], function() {
    Route::get('/', ['as' => 'user.all', 'uses' => 'UsersController@index']);
    Route::post('/', ['as' => 'user.store', 'uses' => 'UsersController@store']);
    Route::get('/{id}', ['as' => 'user.show', 'uses' => 'UsersController@show']);
    Route::put('/{id}', ['as' => 'user.update', 'uses' => 'UsersController@update']);
    Route::delete('/{id}', ['as' => 'user.delete', 'uses' => 'UsersController@delete']);
});