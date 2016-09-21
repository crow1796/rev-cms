<?php 
namespace RevCMS\Modules\Router;
use Route;
class Router {

	/**
	 * Web Routes
	 * @return void 
	 */
	public function webRoutes(){
		Route::group(['namespace' => 'RevCMS\Http\Controllers', 'prefix' => \Config::get('revcms.uri')], function(){
			Route::get('/', 'DashboardController@index');
			Route::resource('/pages', 'PagesController');
			Route::get('/media', 'MediaController@index');
			Route::group(['prefix' => 'settings'], function(){
				Route::get('/settings', 'SettingsController@index');
			});
			// Theme Routes
			Route::group(['prefix' => 'themes'], function(){
				Route::get('/', 'ThemesController@index');
			});

			Route::group(['prefix' => 'developer', 'namespace' => 'Developer'], function(){
				Route::group(['prefix' => 'mvc'], function(){
					Route::group(['prefix' => 'controllers'], function(){
						Route::get('/', 'ControllersController@index');
					});

					Route::group(['prefix' => 'models'], function(){
						Route::get('/', 'ModelsController@index');
					});

					Route::group(['prefix' => 'views'], function(){
						Route::get('/', 'ViewsController@index');
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
		Route::group(['namespace' => 'RevCMS\Http\Controllers', 'prefix' => 'revcms'], function(){
			Route::group(['namespace' => 'Developer'], function(){
				Route::group(['prefix' => '/developer/mvc/controllers'], function(){
					Route::get('/', 'ControllersController@allControllers');
					Route::post('/make', 'ControllersController@create');
					Route::post('/delete-controller', 'ControllersController@deleteControllers');
					Route::patch('/update-controller', 'ControllersController@updateController');
					Route::get('/get-content', 'ControllersController@getContent');
				});
			});

			Route::group(['prefix' => '/themes'], function(){
				Route::get('/installed-themes', 'ThemesController@getInstalledThemes');
			});
		});
	}
}