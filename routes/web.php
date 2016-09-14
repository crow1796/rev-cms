<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'admin', 'namespace' => 'RevCMS'], function(){
	Route::get('/', 'DashboardController@index');
	Route::resource('/pages', 'PagesController');
	Route::get('/media', 'MediaController@index');
	Route::get('/settings', 'SettingsController@index');

	Route::group(['prefix' => 'developer', 'namespace' => 'Developer'], function(){
		Route::resource('/models', 'ModelsController');
		Route::resource('/controllers', 'ControllersController');
		Route::resource('/middlewares', 'MiddlewaresController');
		Route::resource('/requests', 'RequestsController');
		Route::resource('/views', 'ViewsController');
	});
});
