<?php 
namespace RevCMS\Modules\Router;
use Route;
class Router {

	/**
	 * Web Routes
	 * @return void 
	 */
	public function webRoutes(){
		Route::group(['prefix' => \Config::get('revcms.uri')], function(){
			Route::get('/', '\RevCMS\Http\Controllers\DashboardController@index');
			Route::get('/login', '\RevCMS\Http\Controllers\Auth\LoginController@showLoginForm');

			Route::group(['prefix' => 'pages'], function(){
				Route::get('/', '\RevCMS\Http\Controllers\PagesController@index');
				Route::get('/create', '\RevCMS\Http\Controllers\PagesController@create');
			});

			Route::get('/media', '\RevCMS\Http\Controllers\MediaController@index');
			Route::group(['prefix' => 'settings'], function(){
				Route::get('/settings', '\RevCMS\Http\Controllers\SettingsController@index');
			});
			// Theme Routes
			Route::group(['prefix' => 'themes'], function(){
				Route::get('/', '\RevCMS\Http\Controllers\ThemesController@index');
			});

			Route::group(['prefix' => '/developer'], function(){
				Route::group(['prefix' => '/mvc'], function(){
					Route::group(['prefix' => 'controllers'], function(){
						Route::get('/', '\RevCMS\Http\Controllers\Developer\ControllersController@index');
					});

					Route::group(['prefix' => 'models'], function(){
						Route::get('/', '\RevCMS\Http\Controllers\Developer\ModelsController@index');
					});

					Route::group(['prefix' => 'views'], function(){
						Route::get('/', '\RevCMS\Http\Controllers\Developer\ViewsController@index');
					});
				});
			});
		});
	}

	/**
	 * Api Routes
	 * @return  void
	 */
	public function apiRoutes(){
		Route::group(['prefix' => 'revcms'], function(){
			Route::group(['prefix' => '/developer/mvc/controllers'], function(){
				Route::get('/', '\RevCMS\Http\Controllers\Developer\ControllersController@allControllers');
				Route::post('/make', '\RevCMS\Http\Controllers\Developer\ControllersController@create');
				Route::post('/delete-controller', '\RevCMS\Http\Controllers\Developer\ControllersController@deleteControllers');
				Route::patch('/update-controller', '\RevCMS\Http\Controllers\Developer\ControllersController@updateController');
				Route::get('/get-content', '\RevCMS\Http\Controllers\Developer\ControllersController@getContent');
			});

			Route::group(['prefix' => 'pages'], function(){
				Route::post('/store', '\RevCMS\Http\Controllers\PagesController@store');
			});

			Route::group(['prefix' => 'themes'], function(){
				Route::get('/installed-themes', '\RevCMS\Http\Controllers\ThemesController@getInstalledThemes');
			});
		});
	}
}